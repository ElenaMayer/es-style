<?php $this->pageTitle=Yii::app()->name . ' - Ошибка оплаты';?>

<div class="static-page">
    <h2><?php echo CHtml::encode($message); ?>
        <?php if(!Yii::app()->user->isGuest) :?>
            Заказ №<a href="/history/<?= $orderId ?>"> <?= $orderId ?></a>
        <?php endif ?>
    </h2>
    <p class="static-page-info">В случае необходимости, Вы можете оформить заказ повторно.</p>
</div>