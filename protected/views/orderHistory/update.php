<h1>Редактировать заказ №<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array(
    'model'=>$model,
    'modelCartItem' => $modelCartItem)); ?>