<?php

class AjaxController extends Controller
{

    public function actionGetEmail(){
//        echo json_encode(Yii::app()->params['email']);
        echo Yii::app()->params['email'];
        Yii::app()->end();
    }

    public function actionAddToCart(){
        if(Yii::app()->user->isGuest) {
            if (isset(Yii::app()->session['cart'][$_POST['id']])){
                $itemId = Yii::app()->session['cart'][$_POST['id']];
                $cart = Cart::model()->findByPk($itemId);
            } else {
                echo $this->addItemToCart($_POST);
                Yii::app()->end();
            }
        } else {
            if(isset($_POST['size']))
                $cart = Cart::model()->findByAttributes(array(
                    'item_id'=>$_POST['id'],
                    'size'=>$_POST['size'],
                    'user_id'=>Yii::app()->user->id
                ));
            else
                $cart = Cart::model()->findByAttributes(array(
                    'item_id'=>$_POST['id'],
                    'size'=>$_POST['size'],
                    'user_id'=>Yii::app()->user->id
                ));
        }
        if($cart) {
            $cart->count++;
            if($cart->save()) {
                echo true;
                Yii::app()->end();
            } else return false;
        } else {
            echo $this->addItemToCart($_POST);
            Yii::app()->end();
        }

//        $this->renderPartial('_register',array('modelAuth'=>$cart));
    }

    private function addItemToCart($attributes){
        $cart = new Cart();
        $cart->item_id = $attributes['id'];
        if(isset($attributes['size']))
            $cart->size = $attributes['size'];
        if(!Yii::app()->user->isGuest) {
            $cart->user_id = Yii::app()->user->id;
        }
        if($cart->save()) {
            if(Yii::app()->user->isGuest)
                Yii::app()->session['cart'][$attributes['id']] = $cart->id;
            return true;
        } else return false;
    }
}