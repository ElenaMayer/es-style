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
                    'label' => 'Платья',
                    'caption' => 'Изысканные цвета и фасоны.'
                ),
                array(
                    'image' => $this->bu('data/i/carousel_second.jpg'),
                    'label' => 'Блузки',
                    'caption' => 'Качественные материалы и фурнитура.'
                ),
                array(
                    'image' => $this->bu('data/i/carousel_third.jpg'),
                    'label' => 'Кимоно',
                    'caption' => 'Сочетание красоты и комфорта.'
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
    <?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <?php echo News::model()->getNewsByNumber(1)->title;?>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <?php echo News::model()->getNewsByNumber(1)->content;?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <?php echo News::model()->getNewsByNumber(2)->title;?>
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php echo News::model()->getNewsByNumber(2)->content;?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        <?php echo News::model()->getNewsByNumber(3)->title;?>
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php echo News::model()->getNewsByNumber(3)->content;?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>