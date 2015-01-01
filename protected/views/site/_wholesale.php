<h1>Одежда оптом</h1>

<a class="hint hint-link" href="site/price">
    <div class="hint__icon-price"></div><span class="hint__title">Скачать прайс</span>
</a>
<h2>Условия сотрудничестваа</h2>
<ul class="list list_shopping">
    <li class="list__item">Мы работаем с физическими лицами и организаторами совместных покупок.</li>
    <li class="list__item">Минимальная оптовая партия - <b>7 000 руб.</b></li>
    <li class="list__item">Заказ можно сделать через приведенную ниже форму, по телефону <b><?=Yii::app()->params['phone']?></b> или </br>по электронной почте <b><a class="link" id="email">показать адрес</a></b>.</li>
</ul>

<h2>Доставка</h2>
<ul class="list list_shopping">
    <li class="list__item">Доставка по Новосибирску - бесплатно.</li>
    <li class="list__item">Доставка в регионы России осуществляется Почтой России или любой удобной для Вас транспортной компанией.</li>
    <li class="list__item">Доставка до транспортной компании - бесплатно.</li>
</ul>

<h2>Оплата</h2>
<ul class="list list_shopping">
    <li class="list__item">При заказе из Новосибирска возможет наличный и безналичный расчет.</li>
    <li class="list__item">При заказе по России - безналичный расчет, предоплата 100%.</li>
</ul>

<h2>Скидки</h2>
<ul class="list list_shopping">
    <li class="list__item">При заказе от 25 000 рублей - 3%.</li>
    <li class="list__item">При заказе от 50 000 рублей - 5%.</li>
    <li class="list__item">При заказе от 75 000 рублей - 7%.</li>
</ul>

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