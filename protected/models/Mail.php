<?php
/**
 * Created by PhpStorm.
 * User: Elena Mayer
 * Date: 24.11.2015
 * Time: 20:55
 */

class Mail {

    public $to;
    public $from;
    public $subject;
    public $message;

    public function __construct(){
        $this->from = Yii::app()->params['emailFrom'];
    }

    public function send(){

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'To: ' . $this->to . "\r\n";
        $headers .= 'From: Восточный стиль <' . $this->from . ">\r\n";
        $headers .= 'Reply-To: ' . $this->from . "\r\n";

        if (mail($this->to, $this->subject, $this->message, $headers)) {
            $this->saveLog();
        }
    }

    private function saveLog(){
        $log = new MailLog();
        $log->email = $this->to;
        $log->action = Yii::app()->controller->id.'/'.Yii::app()->controller->action->id;
        $log->save();
    }

} 