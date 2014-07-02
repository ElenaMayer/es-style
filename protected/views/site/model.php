<div class="model">
    <div class="table__column table__column_left">
        <div class="table__table">
            <div class="table__cell_flat">
                <div class="model_photo">
                    <?php if($model->is_new) :?>
                        <span class="item__label item__label_new">Новинка</span>
                    <?php endif; ?>
                    <!--span class="item__label">−27%</span-->
                    <img class="model__img" src="<?= $model->getImageUrl(); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="table__column table__column_right">
        <div class="table__cell table__cell_flat">
            <div class="table__table">
                <div class="table__row">
                    <div class="model_header">
                        <h1 class="model_header__title">
                            <span class="model_header__title-name"><?= $model->title; ?></span>
                            <br>
                            <div class="model_header__title-article">Арт.&nbsp;<?= $model->article; ?></div>
                        </h1>
                    </div>
                </div>
                <div class="table__row">
                    <div class="model_detail" >
                        <div class="model__price" >
                            <span class="price price_model">
                                <span itemprop="price"><?= $model->price; ?></span>&nbsp;руб.
                                <!--span class="price__old">1 699&nbsp;руб.</span>
                                <wbr>
                                <span class="price__new">
                                    <span itemprop="price">1 390</span>&nbsp;руб.
                                </span-->
                            </span>
                        </div>
                        <div class="size-chooser">
                            <div class="size-chooser__help">
                                <div class="select" data-form-control="sizesystem">
                                    <input type="hidden" class="js-size-system" name="sizesystem" value="INT">
                                    <span class="button">
                                        <span class="button__title">Размер производителя (INT)</span>
                                    </span>
                                    <!--ul class="dropdown">
                                        <li class="select__item" data-option-value="RUS">
                                            <span class="select__item-label">Российский размер (RUS)</span>
                                            <i class="select__tick"></i>
                                        </li>
                                        <li class="select__item select__item_current" data-option-value="INT">
                                            <span class="select__item-label">Размер производителя (INT)</span>
                                            <i class="select__tick"></i>
                                        </li>
                                    </ul-->
                                </div>
                                <a class="size-chooser__table-link js-defined-table" target="_blank" href="/landing/size-tab/zhenskaya-verhnyaya-odezhda/">Таблица размеров</a>
                            </div>
                            <div class="size-chooser__list">
                                <span class="button">
                                    <span class="button__title size-chooser__size-base" data-size-system="RUS">42</span>
                                    <span class="button__title size-chooser__size-brand" data-size-system="INT">XS</span>
                                </span>
                                <span class="button button_pressed">
                                    <span class="button__title size-chooser__size-base" data-size-system="RUS">42/44</span>
                                    <span class="button__title size-chooser__size-brand" data-size-system="INT">S</span>
                                </span>
                                <span class="button">
                                    <span class="button__title size-chooser__size-base" data-size-system="RUS">44/46</span>
                                    <span class="button__title size-chooser__size-brand" data-size-system="INT">M</span>
                                </span>
                                <span class="button">
                                    <span class="button__title size-chooser__size-base" data-size-system="RUS">48</span>
                                    <span class="button__title size-chooser__size-brand" data-size-system="INT">L</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table__row">
                    <div class="table__cell">
                        <div class="model_desc">
                            <?= $model->description; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>