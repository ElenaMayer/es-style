    <div class="catalog__cont">
        <span>Всего <?= count($model) ?> товаров</span>
    </div>
</div>

<?php
$this->pageTitle='Платья - '.Yii::app()->name;
?>
<div id="data">
    <?php $this->renderPartial('_catalog', array('model'=>$model)); ?>
</div>