<div class="sizes">
    <?php foreach ($model->sizes as $size): ?>
        <span class="button size_button"><?= $size ?></span>
    <?php endforeach; ?>
</div>

<script>
    $( 'body' ).on( 'click', '.size_button', function() {
        $('.size_error').removeClass('size_error');
        $('.button_in-progress').removeClass('button_in-progress');
        $('.button_disabled').removeClass('button_disabled');
        if (!$(this).hasClass('button_pressed')) {
            if ($(".button_pressed").length>0)
                $(".button_pressed").removeClass('button_pressed');
            $(this).addClass('button_pressed');
        }
    });
</script>