<?php
$this->pageTitle=Yii::app()->name;
?>
<div class="banners">
    <?php
    $this->widget(
        'booster.widgets.TbCarousel',
        array(
            'items' => array(
                array(
                    'image' => $this->bu('data/i/carousel_fourth.jpg'),
                ),
                array(
                    'image' => $this->bu('data/i/carousel_first.jpg?4'),
                ),
                array(
                    'image' => $this->bu('data/i/carousel_third.jpg?1'),
                    'label' => 'Восточный стиль',
                    'caption' => '<p>Одежда в восточном стиле - это прежде всего яркие цвета, натуральные материалы и необычные рисунки.</p>'
                ),
            ),
        )
    );
    ?>
</div>

<div class="banners">
    <div class="banners__item">
        <a class="banner__link" href="dress">
            <img class="banner__img" src="<?= $this->bu('data/i/main_dress.jpg?1') ?>" alt="banner">
            <div class="banner__title">Платья</div>
            <span class="banner__description">Изысканные цвета и фасоны</span>
        </a>
    </div>
    <div class="banners__item">
        <a class="banner__link" href="blouse">
            <img class="banner__img" src="<?= $this->bu('data/i/main_blouse.jpg?1') ?>" alt="banner">
            <div class="banner__title">Блузки</div>
            <span class="banner__description">Качественные материалы и фурнитура</span>
        </a>
    </div>
    <div class="banners__item">
        <a class="banner__link" href="kimono">
            <img class="banner__img" src="<?= $this->bu('data/i/main_kimono.jpg?2') ?>" alt="banner">
            <div class="banner__title">Кимоно</div>
            <span class="banner__description">Сочетание красоты и комфорта</span>
        </a>
    </div>
</div>

<div class="main-description">
    <div class="main-title">О компании</div>
    <p>Добро пожаловать в интернет-магазин одежды в восточном стиле!</p>
    <p>У нас вы сможете не просто купить платье, а создать свой собственный образ и наполнить его особым смыслом.</p>
    <p>Ассортимент нашего магазина постоянно обновляется и пополняется новыми моделями на любой вкус и цвет.</p>
    <p>Зарегистрированные пользователи получают актуальную информацию об акциях и скидках на товары, а также персональные скидки.</p>
    <p>В нашем магазине, Вы без труда выберете интересный подарок для Вашего любимого человека, подруги или члена Вашей семьи.</p>
    <p>Ваша дочь, жена, подруга или коллега будут приятно удивлены получив такой подарок на какой-нибудь праздник или просто пусть это будет сюрприз, подаренный им или себе просто "от души".</p>
</div>

<script>
    $(".carousel-inner div:first-child img").css('cursor', 'pointer');
    $(".carousel-inner div:first-child img").click(function(){
        window.location = "<?=Yii::app()->params['carouselUrl']['first']?>";
    });
    $(".carousel-inner div:nth-child(2) img").css('cursor', 'pointer');
    $(".carousel-inner div:nth-child(2) img").click(function(){
        window.location = "<?=Yii::app()->params['carouselUrl']['second']?>";
    });
    $(document).ready(function() {
        if (<?= isset($_GET['login']) ? 1 : 0;?> == 1) {
            jQuery('#auth_form').modal('show');
    } });

</script>