<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.02.2017
 * Time: 14:46
 */
class MailCommand extends CConsoleCommand {

    public function actionNewPhotos() {
        $mail = new Mail();
        $mail->subject = "Новинки интернет-магазина".Yii::app()->params['domain'];

        if(isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new CController('YiiMail');

        $controller->layout = '//layouts/mail_sub';
        $users = User::model()->findAllByAttributes(['is_subscribed'=>1]);
        foreach($users as $user){
            if(!empty($user->email)){
                Yii::app()->userForMail->setUser($user);
                $viewPath = Yii::getPathOfAlias('application.views.site.mail.new_photos').'.php';
                $mail->message = $controller->renderInternal($viewPath, [
                    'photos'=>Photo::model()->getNewPhotos()
                ], true);
                $mail->to = $user->email;

                echo $user->email.PHP_EOL;
                $mail->send();
                echo 'Send'.PHP_EOL;
            }
        }
    }

}