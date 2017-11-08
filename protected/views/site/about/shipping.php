<div class="about">
    <h1>Информация о доставке</h1>
    <div class="shipping">
        <div class="shipping_method">
            <h2>Почта России</h2>
            <ul class="list list_shopping">
                <li class="list__item">Доставка посылки осуществляется ФГУП «Почта России» по всей территории России в указанное отделение почты.</li>
                <li class="list__item">Стоимость доставки составляет <b><?=Yii::app()->params['defaultShippingTariff']?> рублей</b>.</li>
                <li class="list__item red">При заказе трех и более моделей доставка осуществляется бесплатно.</li>
                <li class="list__item">Срок доставки зависит от удаленности региона и составляет, как правило, от 5 дней.</li>
                <li class="list__item">Срок доставки может быть увеличен в случаях, предусмотренных правилами работы Почты России.</li>
                <li class="list__item">Почтовые отправления хранятся в отделении почтовой связи в течение 30 дней.</li>
            </ul>
            <div class="hint">
                <div class="hint__icon-shipping"></div>
                <span class="hint__title">Доставка во все</br>регионы России</span>
            </div>
        </div>
        <div class="shipping_method">
            <h2>Получение в магазине (Только для Новосибирска)</h2>
            <ul class="list">
                <li class="list__item">Вы можете получить заказ в розничном магазине.</li>
                <li class="list__item red"><b>Доставка до розничного магазина осуществляется бесплатно.</b></li>
                <li class="list__item">Если по какой-либо причине Вы не в состоянии получить заказ, свяжитесь с нами по телефону <?= Yii::app()->params['phone'] ?></strong>.</li>
                <li class="list__item">Срок хранения заказов в магазине - <b>4 календарных дня</b>.</li>
                <li class="list__item">Адреса магазинов можно посмотреть в разделе <b><a href="/about/contact" title="Контакты">Контакты</a></b>.</li>
            </ul>
        </div>
    </div>
</div>