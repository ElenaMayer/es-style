<div id="data" class="catalog">
    <div class="catalog__head">
        <div class="catalog__dd">
            <span>Сортировать:</span>
            <?php $this->widget('booster.widgets.TbButtonGroup', array(
                'buttons'=>array(
                    array('label'=>Yii::app()->session['catalog_order'], 'items'=>Photo::model()->getOrderList($type)),
                ),
                'htmlOptions'=>array('class'=>'order_menu')
            )); ?>
        </div>
        <div class="catalog__dd">
            <span>Выбрать размер:</span>
            <?php $this->widget('booster.widgets.TbButtonGroup', array(
                'buttons'=>array(
                    array('label'=>Yii::app()->session['catalog_size'], 'items'=>Photo::model()->getSizes()),
                ),
                'htmlOptions'=>array('class'=>'size_menu')
            )); ?>
        </div>
        <div class="catalog__cont">
            <span>Всего <?= count($model) ?> товаров</span>
        </div>
        <div class="clear"></div>
    </div>
    <div class="catalog__data">
        <?php if(empty($model)): ?>
            <div class="empty">К большому сожалению в этом разделе сейчас нет моделей <?= Yii::app()->session['catalog_size'] ?> размера :(</div>
        <?php else: ?>
            <?php $this->renderPartial('_content', array('model'=>$model, 'type'=>$type)); ?>
        <?php endif; ?>
    </div>
</div>

<script>
    $( document ).ready(function() {
        $(".order_menu>ul.dropdown-menu>li").each(function( index ) {
            if ($(this).text().replace(/^\s+/, "") == '<?=Yii::app()->session['catalog_order']?>'.replace(/^\s+/, "")){
                $(this).addClass('active');
            }
        });
    });
    $( document ).ready(function() {
        $(".size_menu>ul.dropdown-menu>li").each(function( index ) {
            if ($(this).text().replace(/^\s+/, "") == '<?=Yii::app()->session['catalog_size']?>'.replace(/^\s+/, "")){
                $(this).addClass('active');
            }
        });
    });
    $( ".order_menu>ul.dropdown-menu>li>a" ).click(function() {
        order = $(this).text();
        a = $(this);
        $.ajax({
            url: '/<?= $type?>',
            data: {
                order: order
            },
            type: "GET",
            dataType : "html",
            success: function( data ) {
                $('#data').html(data);
            }});
    });
    $( ".size_menu>ul.dropdown-menu>li>a" ).click(function() {
        size = $(this).text();
        a = $(this);
        $.ajax({
            url: '/<?= $type?>',
            data: {
                size: size
            },
            type: "GET",
            dataType : "html",
            success: function( data ) {
                $('#data').html(data);
            }});
    });
</script>