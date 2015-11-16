<div class="customer">
    <div class="table__column table__column_left">
        <ul class="leftside-menu">
            <li class="leftside-menu__item">
                <a href="/customer/">Мои данные</a>
            </li>
            <li class="leftside-menu__item">
                <a href="/history/">Мои заказы</a>
            </li>
            <li class="leftside-menu__item">
                <a href="/cart/">Моя корзина</a>
            </li>
        </ul>
    </div>
    <div class="table__column table__column_right">
        <div class="table__cell account">
            <div id="customer_person_data">
                <?php $this->renderPartial('user/_customer_person_data', array('model'=>$model)); ?>
            </div>

            <div id="customer_shipping_data">
                <?php $this->renderPartial('user/_customer_shipping_data', array('model'=>$model)); ?>
            </div>

            <div id="customer_password_data">
                <?php $this->renderPartial('user/_customer_password_data', array('model'=>$model, 'modelPass' => $modelPass,)); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $( "body" ).on("click", "#submit-button", function() {
        form_id = "#" + $(this).parents('form').attr('id');
        console.log($( form_id));
        $.ajax({
            url: "",
            data: $( "form" + form_id ).serialize(),
            type: "POST",
            dataType: "html",
            success: function (data) {
                if (data) {
                    $( "div" + form_id ).html(data);
                } else {
//                        e.find('button.remove').removeClass('button_in-progress').removeClass('button_disabled');
                }
            }
        });
    });
</script>

