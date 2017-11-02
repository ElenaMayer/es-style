<h1>Редактировать заказ №<?php echo $model->id; ?> <?php if ($model->is_wholesale): ?><span class="red">ОПТ</span><?php endif;?></h1>

<div id="data">
    <?php $this->renderPartial('_form', array(
        'model'=>$model,
        'modelCartItem' => $modelCartItem)); ?>
</div>