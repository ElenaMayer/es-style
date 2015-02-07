<div class="catalog">
    <div class="catalog__head">
        <div class="catalog__sort">
            <span>Сортировать:</span>
            <?php $this->widget('booster.widgets.TbButtonGroup', array(
                'buttons'=>array(
                    array('label'=>Yii::app()->session['catalog_order'], 'items'=>Photo::model()->getOrderList($type)),
                ),
                'htmlOptions'=>array('class'=>'order_menu')
            )); ?>
        </div>
        <div class="catalog__cont">
            <span>Всего <?= count($model) ?> товаров</span>
        </div>
    </div>
    <div id="data" class="catalog__data">
        <?php $this->renderPartial('_content', array('model'=>$model, 'type'=>$type)); ?>
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
    $( "ul.dropdown-menu>li>a" ).click(function() {
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
                $('.order_menu>button').html(order + ' <span class="caret"></span>');
                $('.order_menu>ul.dropdown-menu>li.active').removeClass('active');
                a.parent().addClass('active');
            }});
    });
</script>