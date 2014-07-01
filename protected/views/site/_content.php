<?php foreach($model as $photo) :?>
    <div class="catalog__item">
        <a href="./dress/<?= $photo->article ?>" class="catalog__item__link">
            <?php if($photo->is_new) :?>
                <span class="catalog__item__label catalog__item__label_new">Новинка</span>
            <?php endif; ?>
            <!--span class="catalog__item__label">−27%</span-->
            <img class="catalog__item__img" src="<?= $photo->getPreviewUrl(); ?>">
            <div class="catalog__item__article">Арт.&nbsp;<?= $photo->article ?></div>
            <span class="price">
                <?= $photo->price ?>&nbsp;руб.
                <!--span class="price__old">1 790&nbsp;руб.</span>
                <wbr>
                <span class="price__new">1 290&nbsp;руб.</span-->
            </span>
        </a>
    </div>
<?php endforeach; ?>