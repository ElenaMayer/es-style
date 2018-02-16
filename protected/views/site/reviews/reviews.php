<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/data/images/bg/reviews.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <a class="breadcrumb-item" href="/reviews">Отзывы</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Blog Details Area -->
<section class="htc__blog__details bg__white ptb--70 reviews">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="htc__blog__details__wrap">
                    <div class="comment_form">
                        <?php $this->renderPartial('reviews/_review_form', array('newReview'=>$newReview)); ?>
                    </div>
                    <div class="blog post">
                        <div id="comment-data">
                            <?php $this->renderPartial('reviews/_comments', [
                                'reviews' => $reviews,
                                'pagination' => $pagination
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Pagenation -->
    <div class="row">
        <div class="col-xs-12">
            <?php $this->widget('CLinkPager', array(
                'pages' => $pagination,
                'header' => '',
                'nextPageLabel' => '>',
                'prevPageLabel' => '<',
                'firstPageLabel' => '<<',
                'lastPageLabel' => '>>',
                'selectedPageCssClass' => 'active',
                'maxButtonCount' => Yii::app()->params['maxPagerButtonCount'],
                'htmlOptions' => array('class' => 'htc__pagenation'),
            )); ?>
        </div>
    </div>
    <!-- End Pagenation -->
</section>
<!-- End Blog Details Area -->
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