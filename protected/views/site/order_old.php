<div class="order">
    <?php $this->renderPartial('_'.$type); ?>
    <h2>Заказ</h2>
    <div id="data">
        <?php $this->renderPartial('_order_form_old',array('model'=>$model, 'type'=>$type)); ?>
    </div>
</div>

<script>
$( 'body' ).on( 'click', '#submit', function() {
        $.ajax({
            url: '/<?= $type?>',
            type: 'POST',
            data: $( "#order-form" ).serialize(),
            success: function(responseText){
                $('#data').html(responseText);
                if($('.alert').length){
                    $.each($( "#order-form" ).find('input'), function() {
                        $(this).val('');
                    });
                    $.each($( "#order-form" ).find('textarea'), function() {
                        $(this).val('');
                    });
                }
            }
        });
    });
</script>