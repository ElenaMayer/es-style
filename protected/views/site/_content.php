<?php foreach($model as $photo) :?>
    <div class="catalog__item">
        <a href="/<?= $type ?>/<?= $photo->article ?>" class="catalog__item__link">
            <?php if($photo->is_available) :?>
                <?php if($photo->is_new) :?>
                    <span class="item__label item__label_new_catalog">Новинка</span>
                <?php endif; ?>
                <?php if($photo->is_sale) :?>
                    <span class="item__label">− <?= $photo->sale ?>%</span>
                <?php endif; ?>
            <?php endif; ?>
            <img class="catalog__item__img" src="<?= $photo->getPreviewUrl(); ?>" alt="Женская одежда, <?=$photo->title; ?> арт. <?= $photo->article; ?>">
            <div class="catalog__item__article">Арт.&nbsp;<?= $photo->article ?></div>
            <span class="price">
                <?php if(!$photo->is_available) :?>
                    <div class="not_available_small">Нет в наличии</div>
                <?php else :?>
                    <?php if(!$photo->is_sale) :?>
                        <?= $photo->price ?>&nbsp;руб.
                    <?php else :?>
                        <span class="price__old"><?= $photo->old_price ?>&nbsp;руб.</span>
                        <wbr>
                        <span class="price__new"><?= $photo->new_price ?>&nbsp;руб.</span>
                    <?php endif; ?>
                <?php endif; ?>
            </span>
        </a>
    </div>
<?php endforeach; ?>