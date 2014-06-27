<?php $this->beginContent('//layouts/main'); ?>
<div class="catalog">
    <div class="catalog__head">
        <span class="catalog__sort">
            <strong>Сортировать:</strong>
            <span class="select select_active" data-form-control="order">
                <?php echo CHtml::dropDownList('order', 'new', array(
                        'new' => 'по новинкам',
                        'article' => 'по артиклю',
                        'price_asc' => 'по возрастанию цены',
                        'price_desc' => 'по убыванию цены',
                        'discount' => 'по скидкам',
                    ));?>
            </span>
        </span>
    <?php echo $content; ?>
</div>
<?php $this->endContent(); ?>