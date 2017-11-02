<?php

/**
 * Created by Mayer E.
 * Date: 01.09.2016
 * Time: 13:10
 */
class UserCart extends CApplicationComponent {

    public $currentCart;

    public function init() {
        if(Yii::app()->user->isGuest) {
            if (!empty(Yii::app()->session['cartId']))
                $this->currentCart = Cart::model()->findByPk(Yii::app()->session['cartId']);
            else
                $this->currentCart = null;
        } else {
            $this->currentCart = Cart::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'is_active' => true));
        }
        parent::init();
    }

    public function updateCart(){
        $this->init();
    }
}