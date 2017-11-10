<?php

class AjaxController extends Controller
{

    public function actionGetEmail(){
//        echo json_encode(Yii::app()->params['email']);
        echo Yii::app()->params['email'];
        Yii::app()->end();
    }

    public function actionDeleteItemFromCart(){
        $cartItem = CartItem::model()->findByPk($_POST['item_id']);
        if($cartItem){
            $cartItem->delete();
            $this->renderPartial('/site/cart/_cart_total',array('model'=>$cartItem->cart));
        } else {
            echo false;
            Yii::app()->end();
        }
    }

    public function actionAddToCart(){
        $cart = null;
        if(Yii::app()->user->isGuest && !empty(Yii::app()->session['cartId']))
            $cart = Cart::model()->findByPk(Yii::app()->session['cartId']);
        elseif (!Yii::app()->user->isGuest)
            $cart = Cart::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));

        if($cart) {
            $cartItem = $cart->findAndAddCartItem($_POST);
            if ($cartItem)
                $this->renderPartial('/site/cart/_cart_popup', array('cartItem'=>$cartItem));
            else false;
            Yii::app()->end();
        } else {
            $cart = new Cart;
            if(!Yii::app()->user->isGuest)
                $cart->user_id = Yii::app()->user->id;
            if($cart->save()) {
                if(Yii::app()->user->isGuest)
                    Yii::app()->session['cartId'] = $cart->id;
                $cartItem = $cart->addCartItem($_POST);
                $this->renderPartial('/site/cart/_cart_popup', array('cartItem'=>$cartItem));
            } else return false;
            Yii::app()->end();
        }
    }

    public function actionChangeCount(){
        $cartItem = CartItem::model()->findByPk($_POST['item_id']);
        if($cartItem){
            if ($_POST['action_name'] == 'increase')
                $cartItem->count++;
            elseif ($_POST['action_name'] == 'decrease')
                $cartItem->count--;
            $cartItem->save();
        }
        $this->renderPartial('/site/cart/cart',array('model'=>$cartItem->cart,'path'=>'/site/'));
        Yii::app()->end();
    }

    public function actionGetOrderModal(){
        $this->renderPartial('/site/order/_order_created', array('orderId'=>$_POST['order_id']));
    }

    public function actionRemindPassword(){
        $user = new User;
        $user->scenario = 'remindPassword';
        $user->attributes = Yii::app()->request->getPost('User');
        if ($user->validate()) {
            $user=User::model()->findByAttributes(array('email'=>$_POST['User']['email']));
            $user->createNewPassword();
            if ($user->password_new){
                $this->layout = '//layouts/mail';
                $mail = new Mail();
                $mail->to = $user->email;
                $mail->subject = "Восстановление пароля на ".Yii::app()->params['domain'];
                $mail->message = $this->render('/site/mail/email_remind',array('user'=>$user),true);
                $mail->send();
            }
        }
        $this->renderPartial('/site/auth/_lost',array('modelAuth'=>$user, 'isSent'=>$user->validate()),false,true);
        Yii::app()->end();
    }

    public function actionGetArticlesByCategory(){
        if ($_POST['category']){
            $models = Photo::model()->getArticlesByCategory($_POST['category']);
            echo json_encode($models);
        }
    }
    
    public function actionGetSizesById(){
        if ($_POST['id']){
            $models = Photo::model()->getSizesById($_POST['id']);
            echo json_encode($models);
        }
    }
    
    public function actionGetCartCount(){
        if(Yii::app()->user->isGuest) {
            if (!empty(Yii::app()->session['cartId'])) {
                $cart = Cart::model()->findByPk(Yii::app()->session['cartId']);
                echo $cart->count;
                Yii::app()->end();
            } else {
                echo 0;
                Yii::app()->end();
            }
        } else {
            $cart = Cart::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'is_active' => true));
            echo $cart->count;
            Yii::app()->end();
        }
    }

    public function actionSendRemindMail(){
        $this->layout = '//layouts/mail';
        $order = OrderHistory::model()->findByPk($_POST['order_id']);
        $mail = new Mail();
        $mail->from = Yii::app()->params['emailOrder'];
        $mail->to = $order->email;
        $mail->subject = "Срок хранения Вашего заказа истекает через ".$_POST['day_count'].". Интернет-магазин ".Yii::app()->params['domain'];
        $mail->message = $this->render('/site/mail/order',array('order'=>$order, 'dayCount' => $_POST['day_count']),true);
        echo $mail->send();
        Yii::app()->end();
    }

    public function actionAddModelToOrder(){
        $order = OrderHistory::model()->findByPk($_POST['order_id']);
        if($order){
            if(isset($_POST['item_id'])){
                $newItem = new CartItem();
                $newItem->order_id = $order->id;
                $newItem->item_id = $_POST['item_id'];
                if (isset($_POST['size']))
                    $newItem->size = $_POST['size'];
                $newItem->count = $_POST['count'];
                if ($newItem->photo->is_sale){
                    $newItem->price = $newItem->photo->old_price;
                    $newItem->new_price = $newItem->photo->new_price;
                } else {
                    $newItem->price = $newItem->photo->price;
                }
                if ($newItem->save()){
                    if ($order->recountOrderSum())
                        $this->renderPartial('/orderHistory/_form',array(
                            'model'=>$order,
                            'modelCartItem' => new CartItem()
                        ));
                    else
                        echo json_encode(['error'=>'Ошибка пересчета суммы заказа']);
                } else
                    echo json_encode(['error'=>'Ошибка сохранения модели']);
            } else
                echo json_encode(['error'=>'Не указана модель']);
        } else
            echo json_encode(['error'=>'Заказ не найден']);
        Yii::app()->end();
    }

    public function actionDeleteModelFromOrder(){
        $order = OrderHistory::model()->findByPk($_POST['order_id']);
        if($order){
            $item = CartItem::model()->findByPk($_POST['item_id']);
            if($item){
                if ($item->delete()){
                    if ($order->recountOrderSum())
                        $this->renderPartial('/orderHistory/_form',array(
                            'model'=>$order,
                            'modelCartItem' => new CartItem()
                        ));
                    else
                        echo json_encode(['error'=>'Ошибка пересчета суммы заказа']);
                } else
                    echo json_encode(['error'=>'Ошибка удаления модели']);
            } else
                echo json_encode(['error'=>'Не указана модель']);
        } else
            echo json_encode(['error'=>'Заказ не найден']);
        Yii::app()->end();
    }

    public function actionAddCouponToCart(){
        if(isset($_POST['coupon'])){
            $coupon = Coupon::model()->findByAttributes(['coupon' => trim($_POST['coupon'])]);
            if ($coupon) {
                if(!$coupon->is_used) {
                    if($coupon->until_date >= date("Y-m-d")) {
                        if($coupon->checkCategory(Yii::app()->cart->currentCart->cartItems)){
                            Yii::app()->cart->currentCart->addCoupon($coupon->id);
                            if ($_POST['action'] == 'order')
                                $this->renderPartial('/site/order/_order_total',array('model'=>Yii::app()->cart->currentCart));
                            elseif ($_POST['action'] == 'cart')
                                $this->renderPartial('/site/cart/cart',array('model'=>Yii::app()->cart->currentCart,'path'=>'/site/'));
                        } else
                            echo json_encode(['error'=>'Ни один товар в корзине не подпадает под условия акции']);
                    } else
                        echo json_encode(['error'=>'Срок действия купона истек']);
                } else
                    echo json_encode(['error'=>'Купон использован']);
            } else
                echo json_encode(['error'=>'Купон не найден']);
        } else
            echo false;
        Yii::app()->end();
    }

    public function actionAddAnswerToComment(){
        if (isset($_POST['comment_id']) && isset($_POST['answer'])){
            $comment = new Comment;
            $comment->type = 'review_answer';
            $comment->email = 'admin';
            $comment->item_id = $_POST['comment_id'];
            $comment->comment = $_POST['answer'];
            echo $comment->save();
            Yii::app()->end();
        }
    }

    public function actionSetCommentIsShow(){
        if (isset($_POST['comment_id'])){
            $comment = Comment::model()->findByPk($_POST['comment_id']);
            $comment->is_show = ($comment->is_show) ? 0 : 1;
            echo $comment->save();
            Yii::app()->end();
        }
    }

    public function actionCheckPayment(){
        if(isset($_POST['order_id'])){
            $rk = new Robokassa();
            echo json_encode($rk->checkPayment($_POST['order_id']));
        }
        Yii::app()->end();
    }

    public function actionUpdateSmsDate(){
        if(isset($_POST['order_id'])){
            $order = OrderHistory::model()->findByPk($_POST['order_id']);
            if($order){
                echo $order->setSmsDate();
            }
        }
        Yii::app()->end();
    }

    public function actionSetPhotoParam(){
        $photo = Photo::model()->findByPk($_POST['id']);
        if(empty($photo->$_POST['param']))
            $photo->$_POST['param'] = 1;
        else
            $photo->$_POST['param'] = 0;
        echo $photo->save();
        Yii::app()->end();
    }

    public function actionBannerHasShowed(){
        if(!empty(Yii::app()->session['bannerWithSale'])){
            echo 0;
        } else {
            Yii::app()->session['bannerWithSale'] = 1;
            echo 1;
        }
    }
    public function actionSendCoupon(){
        $email = $_POST['email'];
        $subscription = new Subscription();
        $subscription->email = $email;
        $subscription->save();

        $this->layout = '//layouts/mail';
        if($_POST['action'] == 'catalog')
            $couponStr = Yii::app()->params['catalog_banner_coupon'];
        else
            $couponStr = Yii::app()->params['horoscope_coupon'];
        $coupon = Coupon::model()->findByAttributes(['coupon'=>$couponStr]);
        if($email && $coupon){
            $mail = new Mail();
            $mail->to = $email;
            $mail->from = Yii::app()->params['emailNews'];
            $mail->subject = "Ваш купон на скидку от ".Yii::app()->params['domain']. "!";
            $mail->message = $this->render('/site/mail/coupon', ['model' => $coupon], true);
            $mail->send();
        }
        echo true;
        Yii::app()->end();
    }
    public function actionHoroscopePopupHasShowed(){
        if(!empty(Yii::app()->session['horoscopePopupWithSale'])){
            echo 0;
        } else {
            Yii::app()->session['horoscopePopupWithSale'] = 1;
            echo 1;
        }
    }
}