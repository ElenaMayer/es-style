<?php if($orderId) :?>
    <?php $this->beginWidget(
        'booster.widgets.TbModal',
        array('id' => 'order_created')
    ); ?>

    <div class="modal-body order_modal">
        <a class="close" data-dismiss="modal">&times;</a>
        <h2>Cпасибо за заказ
            <?php if(!Yii::app()->user->isGuest) :?>
                <a href="/history/<?= $orderId ?>"> <?= $orderId ?></a>
            <?php endif ?>!
        </h2>
        <p>Мы свяжемся с Вами в ближайшее время!</p>
        <?php if(!Yii::app()->user->isGuest) :?>
            Следите за статусом заказа в <a href="/history">"Истории заказов"</a>
        <?php endif ?>
    </div>
    <?php $this->endWidget(); ?>

    <script>
        $( '.order_modal' ).on( 'click', '.close', function() {
            window.location = "/";
        });
        $( 'body' ).on( 'click', '#order_created', function() {
            window.location = "/";
        });
    </script>
<?php endif ?>