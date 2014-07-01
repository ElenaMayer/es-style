    <div class="catalog__cont">
        <span>Всего <?= count($model) ?> товаров</span>
    </div>
</div>

<div id="data">
    <?php $this->renderPartial('_content', array('model'=>$model)); ?>
</div>