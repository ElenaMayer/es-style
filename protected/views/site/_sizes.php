<div class="sizes">
    <?php if($model->size_40) :?>
        <span class="button size_button">40</span>
    <?php endif; ?>
    <?php if($model->size_42) :?>
        <span class="button size_button">42</span>
    <?php endif; ?>
    <?php if($model->size_44) :?>
        <span class="button size_button">44</span>
    <?php endif; ?>
    <?php if($model->size_46) :?>
        <span class="button size_button">46</span>
    <?php endif; ?>
    <?php if($model->size_48) :?>
        <span class="button size_button">48</span>
    <?php endif; ?>
    <?php if($model->size_50) :?>
        <span class="button size_button">50</span>
    <?php endif; ?>
    <?php if($model->size_52) :?>
        <span class="button size_button">52</span>
    <?php endif; ?>
    <?php if($model->size_54) :?>
        <span class="button size_button">54</span>
    <?php endif; ?>
</div>

<script>
    $( 'body' ).on( 'click', '.size_button', function() {
        if (!$(this).hasClass('button_pressed')) {
            if ($(".button_pressed").length>0) $(".button_pressed").removeClass('button_pressed');
            $(this).addClass('button_pressed');
        }
    });
</script>