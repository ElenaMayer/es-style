<?php $this->pageTitle=Yii::app()->name . ' - Спасибо за заказ!';?>
<div class="static-page">
    <h2>Cпасибо за заказ
        <?php if(!Yii::app()->user->isGuest) :?>
            №<a href="/history/<?= $order->id ?>"> <?= $order->id ?></a>
        <?php endif ?>!
    </h2>
    <p class="static-page-info">Мы свяжемся с Вами в ближайшее время!</p>
    <?php if(!Yii::app()->user->isGuest) :?>
    <p class="static-page-info">Следите за статусом заказа в <a href="/history">"Истории заказов"</a></p>
    <?php endif ?>
</div>
