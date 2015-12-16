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
                    'image' => $this->bu('data/i/carousel_first.jpg?1'),
                ),
                array(
                    'image' => $this->bu('data/i/carousel_second.jpg?2'),
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
            <img class="banner__img" src="<?= $this->bu('data/i/main_dress.jpg') ?>" alt="banner">
            <div class="banner__title">Платья</div>
            <span class="banner__description">Изысканные цвета и фасоны</span>
        </a>
    </div>
    <div class="banners__item">
        <a class="banner__link" href="blouse">
            <img class="banner__img" src="<?= $this->bu('data/i/main_blouse.jpg') ?>" alt="banner">
            <div class="banner__title">Блузки</div>
            <span class="banner__description">Качественные материалы и фурнитура</span>
        </a>
    </div>
    <div class="banners__item">
        <a class="banner__link" href="kimono">
            <img class="banner__img" src="<?= $this->bu('data/i/main_kimono.jpg?1') ?>" alt="banner">
            <div class="banner__title">Кимоно</div>
            <span class="banner__description">Сочетание красоты и комфорта</span>
        </a>
    </div>
</div>

<div class="banners">
    <h3 class="news">Новости компании</h3>
    <?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
    <div class="panel-group" id="accordion">
        <?php for($i=1;$i<=Yii::app()->params['newsCount'];$i++):?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <p><?= $this->dateFormat(News::model()->getNewsByNumber($i)->date_publish);?></p>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$i;?>">
                            <?php echo News::model()->getNewsByNumber($i)->title;?>
                        </a>
                    </h4>
                </div>
                <div id="collapse_<?= $i?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo News::model()->getNewsByNumber($i)->content;?>
                    </div>
                </div>
            </div>
        <?php endfor;?>
    </div>
    <?php $this->endWidget(); ?>.
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