<div class="breadcrumbs">
    <a href="/" class="breadcrumbs__item">Главная</a>
    <a class="breadcrumbs__item" href="/<?=$type?>"><?=Yii::app()->params["categories"][$type]?></a>
    <span class="breadcrumbs__item"><?=$model->title?> арт. <?=$model->article?></span>
</div>
<div class="model">
    <div class="table__column table__column_left">
        <div class="table__table">
            <div class="table__cell_flat">
                <div class="model_photo">
                    <?php if($model->is_new) :?>
                        <span class="item__label item__label_new">Новинка</span>
                    <?php endif; ?>
                    <?php if($model->is_sale) :?>
                        <span class="item__label">− <?= $model->sale ?>%</span>
                    <?php endif; ?>
                    <a href="<?= $model->getOriginalUrl(); ?>" class="MagicZoom" rel="zoom-height:480px; zoom-width:580px; hint: false;"><img src="<?= $model->getImageUrl(); ?>" alt="Женская одежда, <?=$model->title; ?> арт. <?= $model->article; ?>"/></a>
                </div>
            </div>
        </div>
    </div>
    <div class="table__column table__column_right">
        <div class="table__cell table__cell_flat">
            <div class="table__table">
                <div class="table__row">
                    <div class="model_header">
                        <h1 class="model_header__title"><?= $model->title; ?></h1>
                        <div class="model_header__title-article">Арт.&nbsp;<?= $model->article; ?></div>

                    </div>
                </div>
                <div class="table__row">
                    <div class="model_detail" >
                        <div class="model__price" >
                            <span class="price price_model">
                                <?php if(!$model->is_sale) :?>
                                    <?= $model->price ?>&nbsp;руб.
                                <?php else :?>
                                    <span class="price__old"><?= $model->old_price ?>&nbsp;руб.</span>
                                    <wbr>
                                    <span class="price__new"><?= $model->new_price ?>&nbsp;руб.</span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="size">
                            <?php if(!$model->size) :?>
                                <span class="size__title">Универсальный размер <?php if(!empty($model->uni_size)):?>(подходит на размеры <?= $model->uni_size ?>)<?php endif;?></span>
                            <?php else :?>
                                <span class="size__title">Размеры в наличии:</span>
                                <?php $this->renderPartial('_sizes', array('model'=>$model)); ?>
                            <?php endif; ?>
                        </div>
                        <a class="size__table-link" href="#" data-toggle="modal" data-target="#size_tab">Таблица размеров</a>
                    </div>
                </div>
                <div class="table__row">
                    <div class="table__cell">
                        <div class="model_desc">
                            <?= $model->description; ?>
                        </div>
                    </div>
                </div>
                <div class="table__row">
                    <div class="table__cell social">
                        <div class="social-likes"  data-title="Женская одежда в восточном стиле">
                            <div class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</div>
                            <div class="mailru" title="Поделиться ссылкой в Моём мире">Мой мир</div>
                            <div class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</div>
                            <div class="odnoklassniki" title="Поделиться ссылкой в Одноклассниках">Одноклассники</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->renderPartial('_size_tab'); ?>
