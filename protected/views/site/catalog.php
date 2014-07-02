<div class="catalog">
    <div class="catalog__head">
        <span class="catalog__sort">
            <strong>Сортировать:</strong>
            <?php $this->widget('booster.widgets.TbButtonGroup', array(
                'buttons'=>array(
                    array('label'=>Yii::app()->session['catalog_order'], 'items'=>array(
                        array('label'=>'по новинкам'),
                        array('label'=>'по артиклю'),
                        array('label'=>'по возрастанию цены'),
                        array('label'=>'по убыванию цены'),
                        array('label'=>'по скидкам'),
                    )),
                ),
                'htmlOptions'=>array('class'=>'order_menu')
            )); ?>
        </span>
        <div class="catalog__cont">
            <span>Всего <?= count($model) ?> товаров</span>
        </div>
    </div>
    <div id="data">
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