<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'order-form',
)); ?>
<div class="checkout__inner">
    <div class="accordion-list">
        <div class="accordion">
            <div class="accordion__title">
                Информация о заказе
            </div>
            <div class="accordion__body">
                <div class="accordion__body__form">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkout-method">
                                <?php if (Yii::app()->user->isGuest):?>
                                    <div class="checkout-method__single">
                                        <h5 class="checkout-method__title"><i class="zmdi zmdi-caret-right"></i>Оформить заказ как гость</h5>
                                        <p class="checkout-method__subtitle">Зарегистрируйтесь и получитье доступ к истории заказов и упростите последующие заказы:</p>
                                        <div class="single-input">
                                            <?php echo $form->radioButtonList($user, 'create_profile', ['0'=>'Оформить заказ как гость', '1'=>'Зарегистрироваться']); ?>
                                        </div>
                                        <a class="button button_big button_icon button_right order_auth_btn" data-toggle="modal" data-target="#auth_form">
                                            <span class="button__title">Уже зарегистрированы? Войти</span>
                                        </a>
                                    </div>
                                <?php endif;?>
                                <div class="checkout-method__single">
                                    <h5 class="checkout-method__title"><i class="zmdi zmdi-caret-right"></i>Способ доставки</h5>
                                    <?php if(Cart::isWholesale()) :?>
                                        <div class="single-input">
                                            <?php echo $form->radioButtonList($user, 'tc', Yii::app()->params['tcList']); ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="single-input">
                                            <?php echo $form->radioButtonList($user, 'shipping_method', ['russian_post'=>'Почта России', 'tk' => 'Транспортная компания']); ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="checkout-method__single">
                                    <h5 class="checkout-method__title"><i class="zmdi zmdi-caret-right"></i>Способ оплаты</h5>

                                    <?php if(Cart::isWholesale()) :?>
                                        <div class="single-input">
                                            <input type="radio" checked="checked">
                                            <label for="User_payment">На счет или карту Сбербанка</label>
                                        </div>
                                    <?php else:?>
                                        <div class="single-input">
                                            <?php echo $form->radioButtonList($user, 'payment', Yii::app()->params['paymentMethod']); ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion__title">
                Информация о доставке
            </div>
            <div class="accordion__body">
                <div class="bilinfo">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-input">
                                <?php echo $form->textField($user, 'surname', array(  'placeholder'=>'Фамилия')); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-input">
                                <?php echo $form->textField($user, 'name', array(  'placeholder'=>'Имя *')); ?>
                            </div>
                            <?php if (isset($user->getErrors()['name'])):?>
                                <div class="help-block error"><?= array_shift($user->getErrors()['name']) ?></div>
                            <?php endif ?>
                        </div>
                        <div class="col-md-4">
                            <div class="single-input">
                                <?php echo $form->textField($user, 'middlename', array( 'placeholder'=>'Отчество')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input">
                                <?php echo $form->textField($user, 'phone', array('placeholder'=>'Телефон *')); ?>
                            </div>
                            <?php if (isset($user->getErrors()['phone'])):?>
                                <div class="help-block error"><?= array_shift($user->getErrors()['phone']) ?></div>
                            <?php endif ?>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input">
                                <?php if (Yii::app()->user->isGuest):?>
                                    <?php echo $form->textField($user, 'email', array('placeholder'=>'Электронная почта')); ?>
                                <?php else :?>
                                    <?php echo $form->textField($user, 'email', array('disabled'=>"disabled", 'class' => 'form-control')); ?>
                                <?php endif ?>
                                <?php if (isset($user->getErrors()['email'])):?>
                                    <div class="help-block error"><?= array_shift($user->getErrors()['email']) ?></div>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="order-password" style="display: none">
                            <div class="col-md-6">
                                <div class="single-input">
                                    <?php echo $form->passwordField($user, 'password1', array('placeholder'=>'Пароль')); ?>
                                </div>
                                <?php if (isset($user->getErrors()['password1'])):?>
                                    <div class="help-block error"><?= array_shift($user->getErrors()['password1']) ?></div>
                                <?php endif ?>
                            </div>
                            <div class="col-md-6">
                                <div class="single-input">
                                    <?php echo $form->passwordField($user, 'password2', array('placeholder'=>'Повторите пароль')); ?>
                                </div>
                                <?php if (isset($user->getErrors()['password2'])):?>
                                    <div class="help-block error"><?= array_shift($user->getErrors()['password2']) ?></div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="shipping_data">
                            <div class="col-md-6">
                                <div class="single-input">
                                    <?php echo $form->textField($user, 'postcode', array('placeholder'=>'Почтовый индекс')); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-input">
                                    <?php echo $form->textField($user, 'address', array('placeholder'=>'Адрес')); ?>
                                </div>
                            </div>
                        </div>
                        <?php if(Cart::isWholesale()) :?>
                            <div class="col-md-12">
                                <div class="single-input">
                                    <?php echo $form->textField($user, 'delivery_data', array('placeholder'=>'Дополнительная информация (город, паспортные данные, ФИО получателя)')); ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="col-md-12">
                            <div class="single-input">
                                <?php echo $form->textArea($user, 'comment', array('placeholder'=>'Комментарий')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<script>
    $(document).ready(function() {
        if ($('#User_create_profile_1').prop('checked'))
            $('.order-password').show();
        else
            $('.email_group>label>span').hide();
        if ($('#User_shipping_method_1').prop('checked'))
            shipping_to_store();

        if ($('#User_tc').length > 0){
            if ($('#User_tc').val() == 'pr') {
                $('.wholesale_shipping_data').hide();
            } else {
                $('.shipping_data').hide();
            }
        }
    });
    $( 'body' ).on( 'change', '#User_create_profile_0', function() {
        $('.order-password').hide();
        $('.email_group>label>span').hide();
    });
    $( 'body' ).on( 'change', '#User_create_profile_1', function() {
        $('.order-password').show();
        $('.email_group>label>span').show();
    });
    $( 'body' ).on( 'change', '#User_tc_3', function() {
        if ($('#User_tc_3').prop('checked')){
            shipping_by_post();
        } else {
            shipping_to_store();
        }
    });
    function shipping_by_post() {
        $('.shipping_data').show();
        change_shipping_to_old_value();
    }
    function shipping_to_store() {
        $('.shipping_data').hide();
        change_shipping_to_zero();
    }

    function change_shipping_to_old_value() {
        old_shipping = parseInt($("#User_shipping").val());
        if(!isNaN(old_shipping) && old_shipping > 0) {
            new_total = parseInt($('.cart-total-val').children('span').text()) + old_shipping;
            $('.cart-total-val').children('span').text(new_total.toFixed(0));
            $('.cart-shipping-val').text(old_shipping + " руб.");
        }
    }
    function change_shipping_to_zero() {
        old_shipping = parseInt($("#User_shipping").val());
        if (old_shipping > 0){
            new_total = parseInt($('.cart-total-val').children('span').text()) - old_shipping;
            $('.cart-total-val').children('span').text(new_total.toFixed(0));
        }
        $('.cart-shipping-val').text("0 руб.");
    }

    $("#User_tc").change(function() {
        if($(this).val() == 'pr') {
            $('.wholesale_shipping_data').hide();
            $('.shipping_data').show();
        } else {
            $('.shipping_data').hide();
            $('.wholesale_shipping_data').show();
        }
    });
</script>