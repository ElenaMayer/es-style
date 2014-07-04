<?php $this->pageTitle=Yii::app()->name . ' - Ошибка';?>

<div class="error">
    <h2 class="pull-right">
        Error <?php echo $code; ?>
    </h2>
    <h1>Чтото пошло не так</h1>

    <?php echo CHtml::encode($message); ?>
</div>