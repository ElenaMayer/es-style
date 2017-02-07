<?php

/**
 * Created by Mayer E.
 * User: User
 * Date: 09.01.2017
 * Time: 15:42
 */
class Robokassa {

    private $mrh_login;
    private $mrh_pass1;
    private $mrh_pass2;
    private $inv_desc;
    private $incCurrLabel = "BankCard"; //Оплата банковской картой

    public function __construct(){
        $this->mrh_login = Yii::app()->params['robokassaLogin'];
        $this->mrh_pass1 = Yii::app()->params['robokassaPass1'];
        $this->mrh_pass2 = Yii::app()->params['robokassaPass2'];
        $this->inv_desc = Yii::app()->name;
    }

    public function result($params) {

        // чтение параметров
        $out_summ = $params["OutSum"];
        $inv_id = $params["InvId"];
        $shp_id = $params["Shp_id"];
        $crc = $params["SignatureValue"];

        $crc = strtoupper($crc);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:$this->mrh_pass2:Shp_id=$shp_id"));

        // проверка корректности подписи
        if ($my_crc !=$crc)
        {
            return false;
        }

        //current date
        $tm=getdate(time()+9*3600);
        $date="$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";
        // запись в файл информации о проведенной операции
        // save order info to file
        $f=@fopen("robokassa_payment.txt","a+") or
        die("error");
        fputs($f,"order_num :$inv_id;Summ :$out_summ;Date :$date\n");
        fclose($f);

        $order=OrderHistory::model()->findByPk($shp_id);
        if ($order){
            $order->isPaid();
            return $order;
        } else
            return false;

    }

    public function success($params) {

        // чтение параметров
        // read parameters
        $out_summ = $params["OutSum"];
        $inv_id = $params["InvId"];
        $order_id = $params["Shp_id"];
        $crc = $params["SignatureValue"];

        $crc = strtoupper($crc);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:$this->mrh_pass1:Shp_id=$order_id"));

        // проверка корректности подписи
        // check signature
        if ($my_crc != $crc) {
            return false;
        }

        // проверка наличия номера счета в истории операций
        // check of number of the order info in history of operations
        $order=OrderHistory::model()->findByPk($order_id);
        if ($order){
            $this->checkPayment($order->id);
            return $order;
        } else
            return false;
    }

    public function httpResponse($url){

        try {
            $ch = curl_init();

            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $content = curl_exec($ch);

            if (FALSE === $content)
                throw new Exception(curl_error($ch), curl_errno($ch));
            else
                return $content;

        } catch(Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        }
    }

    public function arrayFromXml($xml) {
        $oXml = simplexml_load_string($xml);
        $json = json_encode($oXml);
        return json_decode($json,true);
    }

    public function getPaymentFormUrlWithOrderIdAndSum($orderId, $sum){
        if(!strstr($sum, '.'))
            $sum .= '.00';
        //@todo номер заказа 12-и значный, робокасса принимает максимум 10-и значный
        $invoiceId = substr($orderId, 0 , -2);
        $crc = md5("$this->mrh_login:$sum:$invoiceId:$this->mrh_pass1:Shp_id=$orderId");
        $url = "https://auth.robokassa.ru/Merchant/Index.aspx?".
            "MerchantLogin=$this->mrh_login&OutSum=$sum&InvoiceID=$invoiceId&Shp_id=$orderId".
            "&Description=$this->inv_desc&IncCurrLabel=$this->incCurrLabel&SignatureValue=$crc";
        if(Yii::app()->params['robokassaDevMode'])
            $url .= "&IsTest=1";
        return $url;
    }

    public function getCheckPaymentUrl($orderId){
        $invoiceId = substr($orderId, 0 , -2);
        $crc = md5("$this->mrh_login:$invoiceId:$this->mrh_pass2");
        $url = "https://auth.robokassa.ru/Merchant/WebService/Service.asmx/OpState?".
            "MerchantLogin=$this->mrh_login&InvoiceID=$invoiceId&Signature=$crc";
        if(Yii::app()->params['robokassaDevMode'])
            $url .= "&IsTest=1";
        return $url;
    }

    public function checkPayment($orderId){
        $url = $this->getCheckPaymentUrl($orderId);
        $xml = $this->httpResponse($url);
        $result = $this->arrayFromXml($xml);
        return $this->handlePaymentData($result, $orderId);
    }

    public function handlePaymentData($data, $orderId){

        /*
            Ошибки $error:
            1 – неверная цифровая подпись запроса;
            3 – информация об операции с таким InvoiceID не найдена.
            4 – найдено две операции с таким InvoiceID.
            1000 - внутренняя ошибка сервиса

            Состояния оплаты $state:
            5 – операция только инициализирована, деньги от покупателя не получены.
            10 – операция отменена, деньги от покупателя не были получены.
            50 – деньги от покупателя получены, производится зачисление денег на счет магазина.
            60 – деньги после получения были возвращены покупателю.
            80 – исполнение операции приостановлено.
            100 – операция выполнена, завершена успешно.
         */
        if (isset($data['Result']) && isset($data['Result']['Code'])) {
            if ($data['Result']['Code'] == 0) {
                if (isset($data['State']) && isset($data['State']['Code'])) {
                    switch ($data['State']['Code']) {
                        case 5:
                            return ['info' => 'Операция только инициализирована, деньги от покупателя не получены'];
                        case 10:
                            if ($this->cancelPayment($orderId))
                                return ['action' => 'Операция отменена, деньги от покупателя не были получены. Заказ отменен'];
                            else
                                return ['error' => 'Ошибка: Не удалось сохранить отмену заказа'];
                        case 60:
                            if ($this->cancelPayment($orderId))
                                return ['action' => 'Деньги после получения были возвращены покупателю. Заказ отменен'];
                            else
                                return ['error' => 'Ошибка: Не удалось сохранить отмену заказа'];
                        case 50:
                            return ['info' => 'Деньги от покупателя получены, производится зачисление денег на счет магазина'];
                        case 80:
                            return ['info' => 'Исполнение операции приостановлено'];
                        case 100:
                            if ($this->confirmPayment($orderId))
                                return ['action' => 'Операция выполнена, завершена успешно. Статус заказа изменен'];
                            else
                                return ['error' => 'Ошибка: Не удалось сохранить оплату заказа'];
                    }
                }
            } else {
                return ['error' => 'Ошибка: '.$data['Result']['Description']];
            }
        }
        return ['error' => 'Ошибка: Неверный формат информации'];
    }

    public function cancelPayment($orderId) {
        $order = OrderHistory::model()->findByPk($orderId);
        if($order) {
            $order->status = 'canceled';
            return $order->save();
        } else
            return false;
    }

    public function confirmPayment($orderId) {
        $order = OrderHistory::model()->findByPk($orderId);
        if($order) {
            $order->status = 'waiting_shipping';
            $order->is_paid = 1;
            return $order->save();
        } else
            return false;
    }

    public function getSumWithCommissionSumUrl($sum){
        $url = "https://auth.robokassa.ru/Merchant/WebService/Service.asmx/CalcOutSumm?".
            "MerchantLogin=$this->mrh_login&IncCurrLabel=$this->incCurrLabel&IncSum=$sum";
        return $url;
    }

    public function getSumWithCommission($sum){
        $url = $this->getSumWithCommissionSumUrl($sum);
        $xml = $this->httpResponse($url);
        $result = $this->arrayFromXml($xml);
        if ($result['OutSum'] > 0)
            return $result['OutSum'];
        else
            return false;
    }
}