<div class="reviews">

    <h1>Отзывы</h1>
    <div class="comment_form">
        <?php $this->renderPartial('reviews/_review_form', array('newReview'=>$newReview)); ?>
    </div>

    <div class="comments">
        <span class="comment-counter"> Всего отзывов
            <i class="cc-comments-count"><?= $pagination->itemCount ?></i>
        </span>
        <ul class="com-list-noava">
            <?php if (!empty($reviews)): ?>
                <?php foreach($reviews as $key => $review): ?>
                    <li class="commentstd clearover">
                        <p class="com-meta">
                            <span class="user_name"><?= $review->name ?></span>
                            <?php if ($review->city): ?>
                                <span class="user_city">(<?= $review->city ?>)</span>
                            <?php endif; ?>
                            <span class="date"><em><?= $this->dateFormatWithTime($review->date_create) ?></em></span>
                            <?php if($review->rating):?>
                                <div class="rating">
                                    <i class="review_rating_icon"></i>
                                    <i class="review_rating_icon <?php if($review->rating < 2 ):?>disabled<?php endif; ?>"></i>
                                    <i class="review_rating_icon <?php if($review->rating < 3 ):?>disabled<?php endif; ?>"></i>
                                    <i class="review_rating_icon <?php if($review->rating < 4 ):?>disabled<?php endif; ?>"></i>
                                    <i class="review_rating_icon <?php if($review->rating < 5 ):?>disabled<?php endif; ?>"></i>
                                </div>
                            <?php endif; ?>
                        </p>
                        <p class="commententry">
                            <?= $review->comment ?>
                        </p>
                        <?php if ($review->img): ?>
                            <p class="commentimg">
                                <img src="<?= $review->getImageUrl(); ?>">
                            </p>
                        <?php endif; ?>
                        <?php if ($review->answer): ?>
                            <div class="comment_ansver">
                                <p class="com-meta_admin">
                                    <span class="admin_name">Восточный стиль</span>
                                    <span class="date"><em><?= $this->dateFormatWithTime($review->answer->date_create) ?></em></span>
                                </p>
                                <p class="commententry_admin">
                                    <?= $review->answer->comment ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
            </li>
        </ul>

        <div class="site_pager">
            <?php $this->widget('CLinkPager', array(
                'pages' => $pagination,
                'header' => '',
                'nextPageLabel' => '>',
                'prevPageLabel' => '<',
                'firstPageLabel' => '<<',
                'lastPageLabel' => '>>',
                'maxButtonCount' => Yii::app()->params['maxPagerButtonCount']
            )); ?>
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        var postcode_to = <?= $userPostcode ?>;
        if(postcode_to)
            get_city_name(postcode_to);
    });
    function get_city_name(postcode_to) {
        postcalc_url = "<?=Yii::app()->params['postcalcUrl']?>";
        postcode_from = <?=Yii::app()->params['postcode']?>;
        url = postcalc_url + '?f=' + postcode_from + '&t=' + postcode_to +'&o=json';
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'jsonp',
            success: function (data) {
                if (data['Status'] == "OK") {
                    city = $.trim(data['Куда']['Название'].replace(/\d+/g, '')).toLowerCase().replace(/^[\u00C0-\u1FFF\u2C00-\uD7FF\w]|\s[\u00C0-\u1FFF\u2C00-\uD7FF\w]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                    $('.comment_city').val(city);
                }
            }
        })
    }
    $( 'body' ).on( 'click', '.review_submit', function() {
        if (!$(this).hasClass("button_disabled")) {
            is_form_valid = true;
            if ($('.comment_name').val().length == 0) {
                $('.comment_name').addClass('error');
                $('.comment_name_error').removeClass('hide');
                $('.table__right-column').addClass('error_form');
                is_form_valid = false;
            } else {
                $('.comment_name').removeClass('error');
                $('.comment_name_error').addClass('hide');
            }
            if ($('.comment_email').val().length == 0) {
                $('.comment_email').addClass('error');
                $('.comment_email_error').text('Это поле необходимо заполнить.');
                $('.comment_email_error').removeClass('hide');
                $('.table__right-column').addClass('error_form');
                is_form_valid = false;
            } else if(!isEmail($('.comment_email').val())) {
                $('.comment_email').addClass('error');
                $('.comment_email_error').text('Неверный формат email.');
                $('.comment_email_error').removeClass('hide');
                $('.table__right-column').addClass('error_form');
                is_form_valid = false;
            } else {
                $('.comment_email').removeClass('error');
                $('.comment_email_error').addClass('hide');
            }
            if ($('.comment_text').val().length == 0) {
                $('.comment_text').addClass('error');
                $('.comment_text_error').removeClass('hide');
                $('.table__right-column').addClass('error_form');
                is_form_valid = false;
            } else {
                $('.comment_text').removeClass('error');
                $('.comment_text_error').addClass('hide');
            }
            if (is_form_valid) {
                $(this).addClass('button_disabled').prop("disabled", true);
                $( "#comment-form" ).submit();
            }
        }
    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $('#Comment_image').change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.review_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>