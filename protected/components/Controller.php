<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function bu($url=null)
    {
        static $baseUrl;
        if ($baseUrl===null)
            $baseUrl=Yii::app()->request->baseUrl;
        return $url===null ? $baseUrl : $baseUrl.'/'.ltrim($url,'/');
    }

    public function dateFormat($date){
        $res = date("d ", strtotime($date));
        $month = date("n", strtotime($date));
        switch ($month){
            case 1: $res.='января';break;
            case 2: $res.='февраля';break;
            case 3: $res.='марта';break;
            case 4: $res.='апреля';break;
            case 5: $res.='мая';break;
            case 6: $res.='июня';break;
            case 7: $res.='июля';break;
            case 8: $res.='августа';break;
            case 9: $res.='сентября';break;
            case 10: $res.='октября';break;
            case 11: $res.='ноября';break;
            case 12: $res.='декабря';break;
        }
        $res .= date(" Y", strtotime($date));
        return $res;
    }

    public function dateFormatWithTime($date){
        $res = $this->dateFormat($date);
        $res .= date(" H:i", strtotime($date));
        return $res;
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
}