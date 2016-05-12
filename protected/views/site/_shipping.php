<h1>Доставка и оплата</h1>

<h2>Как с нами связаться</h2>
<p>Задать вопрос и уточнить интересующую Вас информацию можно несколькими способами:</p>
<ul class="list list_shopping">
    <li class="list__item">Написать нам в социальных сетях.</li>
    <li class="list__item">Написать нам по электронной почте <b><a class="link" id="email">показать адрес</a></b>.</li>
</ul>

<div class="hint">
    <div class="hint__icon-payment"></div>
    <span class="hint__title">Оплата </br>при получении</span>
</div>
<h2>Определение размера</h2>
<p>Вы можете определить размер по <a class="link" href="?size_tab"><b>таблице</b></a>.</p>

<h2>Доставка и оплата</h2>
<ul class="list list_shopping">
    <li class="list__item">После поступления заказа мы свяжемся с Вами по телефону или электронной почте.</li>
    <li class="list__item">После подтверждения заказа, мы вышлем заказ в течении суток.</li>
    <li class="list__item">Мы осуществляем доставку во все регионы России наложенным платежом.</li>
    <li class="list__item red">При заказе трех и более моделей доставка осуществляется бесплатно!</li>
    <li class="list__item">Оплата производится на почте в момент получения посылки.</li>
</ul>

<div class="hint">
    <div class="hint__icon-shipping"></div>
    <span class="hint__title">Доставка во все</br>регионы России</span>
</div>
<h2>Возврат</h2>
<ul class="list list_shopping">
    <li class="list__item">В случае брака мы возвращаем полную стоимость товара.</li>
</ul>
<?php $this->renderPartial('_size_tab'); ?>
<script>
    $( "#email" ).on( "click", function() {
        $.ajax({
            url: '/ajax/getEmail',
            success: function(email){
                $("#email").parent().append('<a href="mailto:'+email+'" class="link">'+email+'</a>');
                $("#email").hide();
            }
        });
    });
</script>