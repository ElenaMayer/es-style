<?php if($_SERVER['REQUEST_URI'] != '/horoscope' && empty(Yii::app()->session['horoscopePopupWithSale'])):?>
    <div class="horoscope_popup">
        <a class="close">×</a>
        <a href="/horoscope">Узнай свой восточный гороскоп и получи подарок! &#127873;</a>
    </div>
<?php endif;?>

<script>
    $('.horoscope_popup').on('click', '.close', function () {
        $.ajax({
            url: '/ajax/horoscopePopupHasShowed',
            type: "GET",
            dataType : "html",
            success: function( data ) {
                $('.horoscope_popup').hide();
            }});
    })
</script>