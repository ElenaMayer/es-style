<?php

class RobokassaController extends Controller
{

    public function actionResult(){

        $robokassa = new Robokassa();
        if ($order = $robokassa->result($_REQUEST)){
            if ($order->user_id)
                $this->redirect(array("historyItem/$order->id"));
            $this->sentMailToAdmin($order);
            echo "OK".$_REQUEST['InvId']."\n";
        } else
            echo "bad sign\n";

    }

    public function actionSuccess(){
        if ($_REQUEST) {
            $rk = new Robokassa();
            if ($order = $rk->success($_REQUEST)){
                $this->render('success', array(
                    'order' => $order,
                ));
            } else {
                $this->render('fail', array(
                    'message' => 'Ошибка работы Robokassa',
                    'orderId' => $order->id,
                ));
            }
        } else {
            $this->redirect(array('site/index'));
        }
    }

    public function actionFail(){
        $orderId = $_REQUEST["Shp_id"];
        $rk = new Robokassa();
        $rk->checkPayment($orderId);
        $this->render('fail', array(
            'message' => "Оплата не была произведена.",
            'orderId' => $orderId
        ));
    }

    public function checkPayment(){
        $rk = new Robokassa();
        $url = $rk->getCheckPaymentUrl($_POST['order_id']);
        $xml = $this->httpResponse($url);
        $result = $this->arrayFromXml($xml);
        $rk = new Robokassa();
        $rk->checkPayment($result, $_POST['order_id']);
    }

    public function sentMailToAdmin($order){
        $this->layout = '//layouts/mail';
        $mail = new Mail();
        $mail->to = Yii::app()->params['emailTo'];
        $mail->subject = "Заказ № ". $order->id . " оплачен.";
        $mail->message = $this->render('/site/mail/order_to_admin',array('order'=>$order),true);
        $mail->send();
    }

}