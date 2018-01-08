<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'comment-form',
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
    <div class="form-group">
        <label class="control-label" for="Comment_comment">Оставить отзыв</label>
        <div class="table__left-column">
            <img class="review_photo" src="/data/i/review_img.jpg">
            <div class="image_file"><?php echo $form->fileField($newReview,'image',[ 'data-buttonText' => "Загрузить фото", 'class' => "filestyle", 'data-input' => "false", 'data-icon' => 'false', 'data-disabled' => (Yii::app()->user->isGuest) ? "true" : "false"]); ?></div>
        </div>
        <div class="table__right-column">
            <div class="table__row"><?php echo $form->textField($newReview, 'name', array('placeholder'=>'Ваше имя', 'class'=>"form-control comment_name", 'disabled' => (Yii::app()->user->isGuest) ? 'disabled' : '')); ?></div>
            <div class="comment_name_error help-block error hide">Это поле необходимо заполнить.</div>
            <div class="table__row"><?php echo $form->textField($newReview, 'email', array('placeholder'=>'Ваш email', 'class'=>"form-control comment_email", 'disabled' => (Yii::app()->user->isGuest) ? 'disabled' : '')); ?></div>
            <div class="comment_email_error help-block error hide"></div>
            <div class="table__row"><?php echo $form->textField($newReview, 'city', array('placeholder'=>'Ваш город', 'class'=>"form-control comment_city", 'disabled' => (Yii::app()->user->isGuest) ? 'disabled' : '')); ?></div>
            <?php echo $form->textArea($newReview,'comment',array('placeholder'=>'Текст сообщения', 'class'=>'form-control comment_text', 'disabled' => (Yii::app()->user->isGuest) ? 'disabled' : '')); ?>
            <div class="comment_text_error help-block error hide">Это поле необходимо заполнить.</div>

            <!--?php if(CCaptcha::checkRequirements() && Yii::app()->user->isGuest):?>
                <div class="table__row short_field">
                    <!--?php $this->widget('CCaptcha')?>
                    <!--?=$form->textField($newReview, 'verifyCode', array('placeholder'=>'Проверочный код', 'class'=>"form-control comment_captcha"))?>
                </div>
                <div class="verifyCode_text_error help-block error hide">Это поле необходимо заполнить.</div>
            <!--?php endif?-->
            <?php if(Yii::app()->user->isGuest) :?>
                <div class="is_guest_comment_msg">Пожалуйста, авторизуйтесь, чтобы оставить отзыв.</div>
            <?php endif; ?>
            <div class="review_rating">
                <?php echo $form->hiddenField($newReview, 'rating'); ?>
                <a class="review_rating_icon inactive <?php if(Yii::app()->user->isGuest && 0) :?>disabled<?php endif; ?>" data-rating="1"></a>
                <a class="review_rating_icon inactive <?php if(Yii::app()->user->isGuest && 0) :?>disabled<?php endif; ?>" data-rating="2"></a>
                <a class="review_rating_icon inactive <?php if(Yii::app()->user->isGuest && 0) :?>disabled<?php endif; ?>" data-rating="3"></a>
                <a class="review_rating_icon inactive <?php if(Yii::app()->user->isGuest && 0) :?>disabled<?php endif; ?>" data-rating="4"></a>
                <a class="review_rating_icon inactive <?php if(Yii::app()->user->isGuest && 0) :?>disabled<?php endif; ?>" data-rating="5"></a>
            </div>
            <a class="btn btn-default review_submit <?php if(Yii::app()->user->isGuest) :?>button_disabled<?php endif; ?>">
                <span class="button__title">Отправить</span>
                <span class="button__progress"></span>
            </a>
        </div>
    </div>

<?php $this->endWidget(); ?>

<script>
    $( ".review_rating_icon" ).mouseover(function() {
        if(!$(this).hasClass('disabled')){
            $(this).removeClass('inactive');
            rating = $(this).attr('data-rating');
            for (i=1; i<rating; i++){
                $('.review_rating_icon[data-rating="'+i+'"]').removeClass('inactive');
            }
            for (i=5; i>rating; i--){
                $('.review_rating_icon[data-rating="'+i+'"]').addClass('inactive');
            }
        }
    });
    $( ".review_rating_icon" ).mouseleave(function() {
        if(!$(this).hasClass('disabled')) {
            $.each($('.review_rating ').children('.review_rating_icon'), function () {
                if (!$(this).hasClass('active'))
                    $(this).addClass('inactive');
                else
                    $(this).removeClass('inactive');
            })
        }
    });
    $( 'body' ).on( 'click', '.review_rating_icon', function() {
        if(!$(this).hasClass('disabled')) {
            $(this).removeClass('inactive').addClass('active selected');
            rating = $(this).attr('data-rating');
            $('#Comment_rating').val(rating);
            for (i = 1; i < rating; i++) {
                $('.review_rating_icon[data-rating="' + i + '"]').removeClass('inactive').addClass('active');
            }
            for (i = 5; i > rating; i--) {
                $('.review_rating_icon[data-rating="' + i + '"]').addClass('inactive').removeClass('active');
            }
        }
    });
</script>