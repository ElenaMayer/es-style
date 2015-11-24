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

    public function init(){
        $this->to = Yii::app()->params['email'];
    }

    public function send(){
        $headers = 'From: ' . $this->from . "\r\n" .
            'Reply-To: ' . $this->from . "\r\n" .
            'Content-type: text/html' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($$this->to, $$this->subject ,$$this->message, $headers);
    }

} 