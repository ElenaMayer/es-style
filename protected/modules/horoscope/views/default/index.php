<div class="horoscope">
    <h1>Восточный гороскоп</h1>
    <div class="horoscope_form">
        <span class="horoscope_form_title">Введите дату рождения</span>
        <form id="horoscope_form" action="/horoscope" method="get">
            <div class="horoscope_form_date">
                <label for="day">День</label>
                <select name="day" class="form-control">
                    <?php for ($i=1;$i<=31;$i++):?>
                        <option <?php if(isset($day) && $i == $day):?>selected<?php endif;?>><?=$i?></option>
                    <?php endfor;?>
                </select>

                <label for="month">Месяц</label>
                <select name="month" class="form-control">
                    <?php for ($i=1;$i<=12;$i++):?>
                        <option <?php if(isset($month) && $i == $month):?>selected<?php endif;?>><?=$i?></option>
                    <?php endfor;?>
                </select>

                <label for="year">Год</label>
                <select name="year" class="form-control">
                    <?php for ($i=1930;$i<=2020;$i++):?>
                        <option <?php if($year && $i == $year):?>selected<?php endif;?>><?=$i?></option>
                    <?php endfor;?>
                </select>
            </div>
            <div class="horoscope_form_sex">
                <label for="sex">Пол</label>
                <input type="radio" name="sex" value="female" <?php if(isset($sex)):?><?php if($sex == 'female'):?>checked<?php endif;?><?php else:?>checked<?php endif;?>>Женский
                <input type="radio" name="sex" value="male" <?php if(isset($sex) && $sex == 'male'):?>checked<?php endif;?>>Мужской
            </div>

            <input type="submit" class="btn btn-default submit" value="Расчитать">
        </form>
    </div>

    <?php if(isset($horoscopeByYear)):?>

        <div class="horoscope_result">
            <div class="horoscope_result_table">
                <div>
                    Знак по восточному календарю: <b class="red"><?= HoroscopeSignByYear::getColorString($colorByYear, $signByYear);?> <?= HoroscopeSignByYear::getSignString($signByYear);?></b>
                </div>
                <div>
                    Знак зодиака: <b class="orange"><?= HoroscopeSignByMonth::getSignString($signByDate);?></b>
                </div>
                <div>
                    Цвета: <?= HoroscopeColorBySign::getColorsStringBySigns([$signByDate, $signByYear]);?></b>
                </div>
            </div>
            <p class="social_title">Поделиться с друзьями</p>
            <div>
                <?php $this->renderPartial('application.views.site._social'); ?>
            </div>
            <div class="horoscope_by_year">
                <h2>Характеристика <b class="red"><?= HoroscopeSignByYear::getSignStringRP($signByYear);?></b></h2>
                <img src="/data/horoscope/<?= $signByYear?>.jpg">
                <p><?= $horoscopeByYear['desc'];?></p>
            </div>
            <div class="horoscope_by_year_color">
                <h2>Год <b class="red"><?= HoroscopeSignByYear::getColorString($colorByYear, $signByYear, true);?> <?= HoroscopeSignByYear::getSignStringRP($signByYear);?></b></h2>
                <p><?= $horoscopeByYear['color_'.$colorByYear.'_desc'];?></p>
            </div>
            <?php if($sex == 'female'):?>
                <div class="horoscope_model">
                    <h2>Подходящие модели</h2>
                    <?php foreach ($models as $model):?>
                        <a href="/<?= $model->model->category ?>/<?= $model->model->article ?>">
                            <img class="catalog__item__img" src="<?= $model->model->getPreviewUrl(); ?>" width="223" height="298" alt="Женская одежда, <?=$model->model->title; ?> арт. <?= $model->model->article; ?>">
                        </a>
                    <?php endforeach;?>
                </div>
            <?php endif;?>
            <div class="horoscope_by_sex">
                <h2><b class="purple"><?= ($sex == 'male')? 'Мужчина' : 'Женщина' ?></b> года <b class="red"><?= HoroscopeSignByYear::getSignStringRP($signByYear);?></b></h2>
                <p><?= $horoscopeByYear['sex_'.$sex.'_desc'];?></p>
            </div>
            <div class="horoscope_by_month">
                <h2>Характеристика <b class="orange"><?= HoroscopeSignByMonth::getSignStringRP($signByDate);?></b></h2>
                <img src="/data/horoscope/<?= $signByDate?>.jpg">
                <p><?= $horoscopeByMonth['desc'];?></p>
            </div>
            <div class="horoscope_by_month">
                <h2><b class="purple"><?= ($sex == 'male')? 'Мужчина' : 'Женщина' ?></b> знака <b class="orange"><?= HoroscopeSignByMonth::getSignString($signByDate);?></b></h2>
                <p><?= $horoscopeByMonth['sex_'.$sex.'_desc'];?></p>
            </div>
            <div class="horoscope_by_year_and_month">
                <h2>Год <b class="red"><?= HoroscopeSignByYear::getSignStringRP($signByYear);?></b> и <b class="orange"><?= HoroscopeSignByMonth::getSignString($signByDate);?></b></h2>
                <p><?= $horoscopeByYearAndMonth['desc'];?></p>
            </div>
            <div class="subscription-fast-pop">
                <h2 class="h2">У нас есть специальный подарок для вас!</h2>
                <p class="subscription-fast-title">
                    <span>Скидка <?= Yii::app()->params['horoscope_sale']?> рублей</span> на любое платье!
                    Введите e-mail и купон на скидку будет выслан сразу же!
                </p>
                <form class="subscription-fast-form" method="post">
                    <div class="subscription-fast-form-input">
                        <label for="subscription-id">Ваш E-mail</label>
                        <input id="subscription-email" name="email" value="" type="text">
                        <div class="popup-email-error error"></div>
                    </div>
                    <span class="btn btn-simple btn-default get-coupon-button">Получить мой подарок!</span>
                </form>
            </div>
        </div>
    <?php endif;?>
</div>
<script>
    if($('.horoscope_result').length > 0) {
        Ya.share2('ya-share2', {
            content: {
                title: 'Мой восточный гороскоп от <?= Yii::app()->params["domain"]; ?>',
                description: $('.horoscope_result_table').html(),
                image: 'http://<?= isset($model->model)?$model->model->getFullPreviewUrl():''; ?>'
            }
        });
    }
    $( '.content' ).on( 'click', '.get-coupon-button', function($e) {
        if(!$("#subscription-email").val()){
            $('.popup-email-error').html('Введите E-mail');
        } else if(!isEmail($("#subscription-email").val())){
            $('.popup-email-error').html('Неверный формат E-mail');
        } else {
            $(this).addClass('button_disabled').prop("disabled", true);
            $.ajax({
                url: "/ajax/sendCoupon",
                data: {
                    email: $("#subscription-email").val(),
                    action: 'horoscope'
                },
                type: "POST",
                dataType: "html",
                success: function (data) {
                    if (data) {
                        $('.subscription-fast-pop').html('<h2>Купон на скидку успешно отправлен!</h2>');
                    }
                }
            });
        }
    });
</script>