<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'auth_form', 'htmlOptions'=>['class'=>'auth_form'])
); ?>
    <div class="modal-body">
        <a class="close" data-dismiss="modal">&times;</a>
        <div class="popup__content">
            <div id="login_form">
                <?php $this->renderPartial('auth/_login', array('modelAuth'=>$modelAuth)); ?>
            </div>
            <div id="register_form" style="display: none;">
                <?php $this->renderPartial('auth/_register', array('modelAuth'=>$modelAuth)); ?>
            </div>
            <div id="lost_form" style="display: none;">
                <?php $this->renderPartial('auth/_lost', array('modelAuth'=>$modelAuth, 'isSent'=>false)); ?>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>

<script>
    $( "#login_form").find( "span.required").each(function() {
        $( this ).hide();
    });

    $( 'body' ).on( 'click', '.login-form__register', function() {
        $( "#login_form" ).hide();
        $( "#register_form" ).show();
    });

    $( 'body' ).on( 'click', '.register-form__login', function() {
        $( "#register_form" ).hide();
        $( "#login_form" ).show();
    });
    $( 'body' ).on( 'click', '.login-form__lost', function() {
        $( "#login_form" ).hide();
        $( "#lost_form" ).show();
    });
    $( 'body' ).on( 'click', '.lost-form__login', function() {
        $( "#lost_form" ).hide();
        $( "#login_form" ).show();
    });
    $( 'body' ).on( 'click', '.auth_button', function() {
        $(this).parent().addClass('button_in-progress').addClass('button_disabled');
        $(this).parent().prop("disabled", true);
    })
</script>