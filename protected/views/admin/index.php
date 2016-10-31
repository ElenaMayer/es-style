<?php

$this->pageTitle=Yii::app()->name;
?>

<h1>Добро пожаловать в <i>админку!</i></h1>

<p>Инструкция для чайников:</p>
<ul>
	<li>Загрузка фоток находится в разделе <code>Галерея</code></li>
    <li>Новости добавлять в разделе <code>Новости</code></li>
    <li>Заказы смотреть в разделе <code>Заказы</code></li>
    <li>Прайсы загружать в разделе <code>Прайсы</code></li>
	<li>Чтоб добавить фото, нажать кнопку <code>Добавить</code></li>
    <li>Чтоб сохранить фото, нажать кнопку <code>Сохранить</code></li>
    <li>Чтоб отредактировать фото, нажать на <code>Зеленый карандашик</code></li>
    <li>Чтоб удалить фото, нажать на <code>Красный крестик</code>, но лучше этого не делать, вместо этого:</li>
    <li>Чтоб удалить фото с сайта, нажать на <code>Голубую иконку с надписью Show</code></li>
</ul>

<a class="admin_title_link sand_mail_button button">Отправить рассылку "Отзыв за купон"</a>

<script>
    $( "body" ).on("click", ".sand_mail_button", function() {
        if (!$(this).hasClass("button_disabled")) {
            var count = prompt("Количество пользователей:", 10);
            if (count) {
                $('.sand_mail_button').addClass('button_disabled');
                $.ajax({
                    url: "/ajax/sendReviewForCouponMail",
                    data: {
                        count: count
                    },
                    type: "POST",
                    dataType: "html",
                    success: function (data) {
                        $('.sand_mail_button').removeClass('button_disabled');
                        alert('Отправлено');
                    }
                });
            }
        }
    });

</script>