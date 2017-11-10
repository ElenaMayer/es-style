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
        $mail->from = Yii::app()->params['emailNews'];
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

    // php yiic mail reviewForCouponMail --test=1 - Рассылка "Отзыв за купон"
    // php yiic mail reviewForCouponMail --count=20 - Рассылка "Отзыв за купон"
    public function actionReviewForCouponMail($count=10, $test=0) {
        // coupon_mail_flag - флаг, что письмо уже отправлялось

        $this->checkNewOrdersForReview();

        if(isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new CController('YiiMail');
        $controller->layout = '//layouts/mail';
        $mail = new Mail();
        $mail->from = Yii::app()->params['emailNews'];
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

    // php yiic mail saleMail --sendToOrderedUser=0 - Рассылка купонов на скидку
    public function actionSaleMail($sendToOrderedUser = 1) {

        $subject = "🔥 Вот это да! 200 рублей в подарок от интернет-магазина ".Yii::app()->params['domain']." 🔥";
        $coupon = Coupon::model()->findByAttributes(['coupon'=>'SALE200']);
        $this->sendMailToSubscribers($subject, 'coupon', $sendToOrderedUser, ['model'=>$coupon]);
    }

    // php yiic mail oneModelSaleMail --article=11010 --sale=20 --saleType=percent --sendToOrderedUser=0 - Скидка на одно платье
    public function actionOneModelSaleMail($article, $sale, $saleType = 'sum', $sendToOrderedUser = 1) {
        $model = Photo::model()->findByAttributes(['article'=>$article]);
        if(!empty($model)){
            $subject = "Только сегодня! 💥 Максимальная выгода! Скидка ".$sale.($saleType=='sum'?' руб.':'%')." для вас! ➜  ".Yii::app()->params['domain'];
            $this->sendMailToSubscribers($subject, 'one_model_sale', $sendToOrderedUser, ['model'=>$model, 'sale'=>$sale, 'saleType' => $saleType]);
        } else {
            echo 'Model not found' . PHP_EOL;
        }
    }

    public function sendMailToSubscribers($subject, $view, $sendToOrderedUser, $params=[], $isTest = 0){
        $mail = new Mail();
        $mail->from = Yii::app()->params['emailNews'];
        $mail->subject = $subject;

        if(isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new Controller('YiiMail');

        $controller->layout = Yii::getPathOfAlias('application.views.layouts.mail_sub').'.php';
        $users = User::model()->findAllByAttributes(['is_subscribed'=>1]);
        $mailCount = 0;
        $viewPath = Yii::getPathOfAlias('application.views.site.mail.'.$view).'.php';
        if($params['model'])
            $mail->message = $controller->renderInternal($controller->layout, ['content'=>($controller->renderInternal($viewPath, ['model' => $params['model'], 'params' => $params], true))], true);
        else
            $mail->message = $controller->renderInternal($viewPath, ['params' => $params], true);
        if (!$isTest) {
            foreach($users as $user){
                if(!empty($user->email)) {
                    if ($sendToOrderedUser || (!$sendToOrderedUser && count($user->orders) == 0)) {
                        Yii::app()->userForMail->setUser($user);
                        $mail->to = $user->email;

                        echo $user->email . PHP_EOL;
                        $mail->send();
                        $mailCount++;
                        echo 'Sent' . PHP_EOL;
                    }
                }
            }
        } else {
            $mail->to = Yii::app()->params['email'];

            echo Yii::app()->params['email'] . PHP_EOL;
            $mail->send();
            echo 'Sent' . PHP_EOL;
        }

        echo $mailCount.' mail was sent' . PHP_EOL;
    }


    public function sendMailToAll($subject, $view, $params=[], $isTest = 0){
        $mail = new Mail();
        $mail->from = Yii::app()->params['emailNews'];
        $mail->subject = $subject;

        if(isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new Controller('YiiMail');

        $controller->layout = Yii::getPathOfAlias('application.views.layouts.mail_sub').'.php';
        $mailCount = 0;
        $viewPath = Yii::getPathOfAlias('application.views.site.mail.'.$view).'.php';
        if($params['model'])
            $mail->message = $controller->renderInternal($controller->layout, ['content'=>($controller->renderInternal($viewPath, ['model' => $params['model'], 'params' => $params], true))], true);
        else
            $mail->message = $controller->renderInternal($viewPath, ['params' => $params], true);
        if (!$isTest) {
            foreach($this->getEmailToSendMail() as $email){
                if(!empty($email)) {
                    $mail->to = $email;

                    echo $email . PHP_EOL;
                    $mail->send();
                    $mailCount++;
                    echo 'Sent' . PHP_EOL;
                }
            }
        } else {
            $mail->to = Yii::app()->params['email'];

            echo Yii::app()->params['email'] . PHP_EOL;
            $mail->send();
            echo 'Sent' . PHP_EOL;
        }

        echo $mailCount.' mail was sent' . PHP_EOL;
    }

    // php yiic mail NewsMail --news_id=1 --sendToOrderedUser=0 --isTest = 0 - Новостная рассылка
    public function actionNewsMail($news_id, $isTest = 0) {
        $model = News::model()->findByAttributes(['id'=>$news_id]);
        if(!empty($model)){
            $subject = $model->title;
            $this->sendMailToAll($subject, 'news_mail', ['model'=>$model], $isTest);
        } else {
            echo 'Model not found' . PHP_EOL;
        }
    }

    private function getEmailToSendMail(){
        $subscriptions = Subscription::model()->findAll();
        $subscriptionArr = CHtml::listData( $subscriptions, 'id' , 'email');

        $orders = OrderHistory::model()->findAll(array(
            'select'=>'id, email'));
        $orderArr = CHtml::listData( $orders, 'id' , 'email');

        $users = User::model()->findAll(array(
            'select'=>'id, email'));
        $userArr = CHtml::listData( $users, 'id' , 'email');

        $result = array_unique(array_merge ( $subscriptionArr, $orderArr, $userArr ));

        $usersUnsub = User::model()->findAllByAttributes(['is_subscribed'=>0], array('select'=>'id, email'));
        $usersUnsubArr = CHtml::listData( $usersUnsub, 'id' , 'email');

        $unsetArr = array_intersect($usersUnsubArr, $result);
        foreach ($unsetArr as $unset) {
            $key = array_search($unset, $result);
            unset($result[$key]);
        }

        return $result;
    }
}