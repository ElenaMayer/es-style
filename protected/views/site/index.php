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
                    'image' => $this->bu('data/i/carousel_first.jpg'),
                    'label' => 'Восточный стиль',
                    'caption' => '<p>Восточные традиции всё прочнее входят в нашу жизнь. </p><p>Одежда в восточном стиле - это прежде всего яркие цвета, натуральные материалы и необычные рисунки.</p>'
                ),
                array(
                    'image' => $this->bu('data/i/carousel_second.jpg'),
                    'label' => 'Новинки',
                    'caption' => '<p>Постоянно пополняющийся ассортимент дизайнерских моделей. </p><p>Оригинальные формы и узоры предоставляют небывалые возможности для самовыражения.</p>'
                ),
                array(
                    'image' => $this->bu('data/i/carousel_third.jpg'),
                    'label' => 'Скидки',
                    'caption' => '<p>Всегда новые акции и уникальные спецпредложения. </p><p>Фиксированная система скидок позволяет получить наибольшую выгоду при покупке.</p> '
                ),
            ),
        )
    );
    ?>
</div>

<div class="banners">
    <div class="banners__item item__first">
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
    <div class="banners__item item__last">
        <a class="banner__link" href="kimono">
            <img class="banner__img" src="<?= $this->bu('data/i/main_kimono.jpg') ?>" alt="banner">
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
    <?php $this->endWidget(); ?>
</div>