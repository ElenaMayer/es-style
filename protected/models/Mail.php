<?php
/**
 * Created by PhpStorm.
 * User: EZcool
 * Date: 24.11.2015
 * Time: 20:55
 */

class Mail {

    public $to;
    public $from;
    public $subject;
    public $message;

    public function __construct(){
        $this->from = Yii::app()->params['email'];
    }

    public function send(){
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'To: ' . $this->to . "\r\n";
        $headers .= 'From: Восточный стиль <' . $this->from . ">\r\n";
        $headers .= 'Reply-To: ' . $this->from . "\r\n";

        mail($this->to, $this->subject, $this->message, $headers);
    }

} 