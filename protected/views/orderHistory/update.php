<h1>Редактировать заказ №<?php echo $model->id; ?></h1>

<div id="data">
    <?php $this->renderPartial('_form', array(
        'model'=>$model,
        'modelCartItem' => $modelCartItem)); ?>
</div>
