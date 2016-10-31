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
    <li class="list__item">Стоимость доставки расчитывается по тарифам Почты России в зависимости от региона.</li>
    <li class="list__item red">При заказе трех и более моделей доставка осуществляется бесплатно!</li>
    <li class="list__item">Оплата производится на почте в момент получения посылки.</li>
    <li class="list__item">Комиссия за наложенный платеж состовляет 1% - 5% и оплачивается при получении.</li>
    <li class="list__item">Жители Новосибирске могут забрать свой заказ в точке розничной продажи с оплатой при получении.</li>
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


<h2>Точка розничной продажи в Новосибирске</h2>
<div class="contacts">
    Адрес: Мичурина 12 - Ряд №6 Место №184
</div>
<div class="contacts">
    Время работы: 10:00 - 19:00 Без выходных
</div>
<div id="map_rinok" class="gis_map"></div>

<script src="http://maps.api.2gis.ru/2.0/loader.js?pkg=full" data-id="dgLoader"></script>
<script type="text/javascript">
    var map_rinok;
    DG.then(function () {
        map_rinok = DG.map('map_rinok', {
            "center": [55.042049, 82.924407],
            "zoom": 16
        });
        DG.marker([55.027069, 82.921052]).addTo(map_rinok);
        DG.marker([55.042049, 82.924407]).addTo(map_rinok);
        DG.marker([54.982592, 82.891341]).addTo(map_rinok);
    });
</script>

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