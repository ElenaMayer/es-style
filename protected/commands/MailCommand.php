<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.02.2017
 * Time: 14:46
 */
class MailCommand extends CConsoleCommand {

    // php yiic mail newPhotos - Новиночная рассылка
    public function actionNewPhotos() {
        $mail = new Mail();
        $mail->subject = "Новинки интернет-магазина ".Yii::app()->params['domain'];

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

    // php yiic mail reviewForCouponMail --test=true - Рассылка "Отзыв за купон"
    // php yiic mail reviewForCouponMail --count=20 - Рассылка "Отзыв за купон"
    public function actionReviewForCouponMail($count=10, $test=false) {
        // coupon_mail_flag - флаг, что письмо уже отправлялось

        $this->checkNewOrdersForReview();

        if(isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new CController('YiiMail');
        $controller->layout = '//layouts/mail';
        $mail = new Mail();
        $mail->subject = "Скидка за отзыв от интернет-магазина".Yii::app()->params['domain'];
        if($test){
            echo 'TEST MODE' . PHP_EOL;
            $orders=OrderHistory::model()->findAllByAttributes(['email'=> Yii::app()->params['testEmail']]);
        } else {
            $sql = "SELECT * FROM `order_history` WHERE `status` = 'completed' AND (coupon_mail_flag = 0 OR coupon_mail_flag IS NULL)";
            if($count != 'all'){
                $sql .= " LIMIT ".$count;
            }
            $orders=OrderHistory::model()->findAllBySql($sql);

        }

        foreach($orders as $order){
            if(!empty($order->email)) {
                if (!empty($order->user_id)) {
                    Yii::app()->userForMail->setUser($order->user);
                }
                $viewPath = Yii::getPathOfAlias('application.views.site.mail.coupon_for_review').'.php';
                $mail->message = $controller->renderInternal($viewPath, [
                    'order' => $order
                ], true);
                $mail->to = $order->email;

                echo $order->email . PHP_EOL;
                if($mail->send()){
                    $order->reviewForCouponMailIsSent();
                    echo 'Sent' . PHP_EOL;
                } else {
                    echo 'Failed to send!' . PHP_EOL;
                }
            }
        }
    }

    private function checkNewOrdersForReview(){
        echo 'Check new comments' . PHP_EOL;
        $mailLogCriteria = new CDbCriteria;
        $mailLogCriteria->select = new CDbExpression('MAX(send_date) AS maxDate');
        $mailLogCriteria->compare('action', 'ajax/sendReviewForCouponMail');
        $mailLog = MailLog::model()->find($mailLogCriteria);
        $maxDate = $mailLog['maxDate'];

        $commentCriteria = new CDbCriteria;
        $commentCriteria->compare('type', 'reviews');
        $commentCriteria->condition="date_create >= '$maxDate'";
        $comments = Comment::model()->findAll($commentCriteria);

        foreach ($comments as $comment){
            echo 'Check '. $comment->email . PHP_EOL;
            $order = OrderHistory::model()->findByAttributes(['email' => $comment->email]);
            if($order){
                echo 'Find order for '. $comment->email . PHP_EOL;
                $order->reviewForCouponMailIsSent();
            }
        }
        echo 'New comments was checked' . PHP_EOL;
    }

    // php yiic mail saleMail --sendToOrderedUser=false - Рассылка купонов на скидку
    public function actionSaleMail($sendToOrderedUser = true) {
        $mail = new Mail();
        $mail->subject = "200 рублей в подарок от интернет-магазина ".Yii::app()->params['domain'];

        if(isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new CController('YiiMail');

        $controller->layout = '//layouts/mail';
        $users = User::model()->findAllByAttributes(['is_subscribed'=>1]);
        foreach($users as $user){
            if(!empty($user->email)) {
                if ($sendToOrderedUser || count($user->orders) < 1) {
                    Yii::app()->userForMail->setUser($user);
                    $coupon = Coupon::model()->findByAttributes(['coupon'=>'SALE200']);
                    $viewPath = Yii::getPathOfAlias('application.views.site.mail.coupon').'.php';
                    $mail->message = $controller->renderInternal($viewPath, [
                        'coupon' => $coupon
                    ], true);
                    $mail->to = $user->email;

                    echo $user->email . PHP_EOL;
                    $mail->send();
                    echo 'Send' . PHP_EOL;
                }
            }
        }
    }

}