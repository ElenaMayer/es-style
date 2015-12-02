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
            $this->renderPartial('../site/cart/_cart_total',array('model'=>$cartItem->cart));
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
                $this->renderPartial('../site/cart/_cart_popup', array('cartItem'=>$cartItem));
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
                $this->renderPartial('../site/cart/_cart_popup', array('cartItem'=>$cartItem));
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
            if ($cartItem->save())
                echo $cartItem->count;
            else
                echo 0;
            Yii::app()->end();
        } else {
            echo 0;
            Yii::app()->end();
        }
    }

    public function actionGetOrderModal(){
        $this->renderPartial('../site/order/_order_created', array('orderId'=>$_POST['order_id']));
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
                $this->render('../site/mail/email_remind',array('user'=>$user));
//                $mail->message = $this->render('../site/mail/email_remind',array('user'=>$user),true);
//                $mail->send();
            }
        }
        $this->renderPartial('../site/auth/_lost',array('modelAuth'=>$user, 'isSent'=>$user->validate()),false,true);
        Yii::app()->end();
    }
}