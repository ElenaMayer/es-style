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
                                            <?php echo $form->radioButton($user, 'create_profile', ['value'=>'0', 'checked'=>"checked"]); ?>
                                            <label for="User_create_profile">Оформить заказ как гость</label>
                                        </div>
                                        <div class="single-input">
                                            <?php echo $form->radioButton($user, 'create_profile', ['value'=>'1']); ?>
                                            <label for="User_create_profile">Зарегистрироваться</label>
                                        </div>
                                    </div>
                                    <div class="order-password hide">
                                        <div class="row">
                                            <?php echo $form->passwordFieldGroup($user, 'password1', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
                                        </div>
                                        <div class="row">
                                            <?php echo $form->passwordFieldGroup($user, 'password2', array('placeholder'=>'', 'autocomplete' => 'off')); ?>
                                        </div>
                                    </div>
                                <?php endif;?>
                                <div class="checkout-method__single">
                                    <h5 class="checkout-method__title"><i class="zmdi zmdi-caret-right"></i>Способ доставки</h5>
                                    <?php if(Cart::isWholesale()) :?>
                                        <?php foreach (Yii::app()->params['tcList'] as $tc => $tcTitle):?>
                                            <div class="single-input">
                                                <?php echo $form->radioButton($user, 'tc', ['value'=>$tc, 'checked' => ($tc == 'pec')?"checked":'']); ?>
                                                <label for="User_tc"><?= $tcTitle ?></label>
                                            </div>
                                        <?php endforeach;?>
                                    <?php else: ?>
                                        <div class="single-input">
                                            <?php echo $form->radioButton($user, 'shipping_method', ['value'=>'russian_post', 'checked'=>"checked"]); ?>
                                            <label for="User_shipping_method">Почта России</label>
                                        </div>
                                        <div class="single-input">
                                            <?php echo $form->radioButton($user, 'shipping_method', ['value'=>'store']); ?>
                                            <label for="User_shipping_method">Получение в магазине (для Новосибирска)</label>
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
                                            <?php echo $form->radioButton($user, 'payment', ['value'=>'cod', 'checked'=>"checked"]); ?>
                                            <label for="User_payment">При получении</label>
                                        </div>
                                        <div class="single-input">
                                            <?php echo $form->radioButton($user, 'payment', ['value'=>'online']); ?>
                                            <label for="User_payment">Онлайн-оплата</label>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <?php if (Yii::app()->user->isGuest):?>
                                <?php $this->renderPartial('application.views.site.auth._login', array('modelAuth'=>new User('registration'))); ?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion__title">
                Информация о доставке
            </div>
            <div class="accordion__body">
                <div class="bilinfo">
                    <form action="#">
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
                            </div>
                            <div class="col-md-4">
                                <div class="single-input">
                                    <?php echo $form->textField($user, 'middlename', array( 'placeholder'=>'Отчество')); ?>
                                </div>
                            </div>
                            <?php if (isset($user->getErrors()['name'])):?>
                                <div class="help-block error"><?= array_shift($user->getErrors()['name']) ?></div>
                            <?php endif ?>
                            <div class="col-md-6">
                                <div class="single-input">
                                    <?php echo $form->textField($user, 'phone', array('placeholder'=>'Телефон *')); ?>
                                </div>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<script>
    $(document).ready(function() {
        if ($('#User_create_profile').prop('checked'))
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
    $( 'body' ).on( 'change', '#User_create_profile', function() {
        if($(this).prop('checked')) {
            $('.order-password').show();
            $('.email_group>label>span').show();
        } else {
            $('.order-password').hide();
            $('.email_group>label>span').hide();
        }
    });
    $( 'body' ).on( 'change', '#User_shipping_method', function() {
        if($(this).find(":selected").val() == 'russian_post') {
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