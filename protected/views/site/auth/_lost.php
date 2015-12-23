<div id="lost-form_data" class='lost-form'>
    <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'=>'lost-form',
        'htmlOptions' => array(),
    )); ?>
    <div class="auth-popup__subtitle">Восстановление пароля</div>
    <?php if(!$isSent):?>
        <div class="popup__info">Пожалуйста, введите Ваш адрес электронной почты, на который </br>мы можем выслать Ваш новый пароль.</div>
        <?php echo CHtml::hiddenField('action', Yii::app()->controller->action->id); ?>
        <div class="row">
            <?php echo $form->textFieldGroup($modelAuth, 'email', array('placeholder'=>'', 'htmlOptions'=>['class'=>'login_form'])); ?>
        </div>
        <div class="form__controls">
            <span class="button button_blue">
            <?php echo CHtml::ajaxSubmitButton('Восстановить',
                CHtml::normalizeUrl(array('/ajax/remindPassword')),
                array(
                    'type' => 'POST',
                    'success' => 'js: function(data) {
                                    if (data) {
                                        $("#lost-form").html(data);
                                        $(".button_in-progress").removeClass("button_in-progress").removeClass("button_disabled").prop( "disabled", false );
                                        }
                                    } '
                ),
                array(
                    'class' => 'auth_button'
                )); ?>
                <span class="button__progress"></span>
            </span>
            <span class="lost-form__login link">Вспомнил</span>
        </div>
    <?php else :?>
        <span class="form__success"></span>
        <span class="form__description">Новый пароль отправлен на ваш e-mail.<br>Пожалуйста, проверьте почту.</span>
    <?php endif ?>
    <?php $this->endWidget(); ?>
</div>
<script>
    $( 'body' ).on( 'click', '.auth_form', function() {
        if($('.form__success').length > 0)
            window.location.reload();
    });
    $( '.auth_form' ).on( 'click', '.close', function() {
        if($('.form__success').length > 0)
            window.location.reload();
    });
</script>