<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(/data/images/bg/about.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="/">Главная</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Доставка</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Contact Area -->
<section class="htc__contact__area ptb--70 bg__white">
    <div class="container-fluid">
        <div class="about">
            <h1>Информация о доставке</h1>
            <div class="shipping">
                <div class="shipping_method">
                    <h2>Почта России</h2>
                    <ul class="list list_shopping">
                        <li class="list__item"><i class="zmdi zmdi-local-shipping"></i>Доставка посылки осуществляется ФГУП «Почта России» по всей территории России в указанное отделение почты.</li>
                        <li class="list__item"><i class="zmdi zmdi-local-shipping"></i>Стоимость доставки составляет <b><?=Yii::app()->params['defaultShippingTariff']?> рублей</b>.</li>
                        <li class="list__item red"><i class="zmdi zmdi-local-shipping"></i></i>При заказе трех и более моделей доставка осуществляется бесплатно.</li>
                        <li class="list__item"><i class="zmdi zmdi-local-shipping"></i>Срок доставки зависит от удаленности региона и составляет, как правило, от 5 дней.</li>
                        <li class="list__item"><i class="zmdi zmdi-local-shipping"></i>Срок доставки может быть увеличен в случаях, предусмотренных правилами работы Почты России.</li>
                        <li class="list__item"><i class="zmdi zmdi-local-shipping"></i>Почтовые отправления хранятся в отделении почтовой связи в течение 30 дней.</li>
                    </ul>
                </div>
                <div class="shipping_method">
                    <h2>Получение в магазине (Только для Новосибирска)</h2>
                    <ul class="list">
                        <li class="list__item"><i class="zmdi zmdi-local-shipping"></i>Вы можете получить заказ в розничном магазине.</li>
                        <li class="list__item red"><i class="zmdi zmdi-local-shipping"></i><b>Доставка до розничного магазина осуществляется бесплатно.</b></li>
                        <li class="list__item"><i class="zmdi zmdi-local-shipping"></i>Если по какой-либо причине Вы не в состоянии получить заказ, свяжитесь с нами по телефону <?= Yii::app()->params['phone'] ?></strong>.</li>
                        <li class="list__item"><i class="zmdi zmdi-local-shipping"></i>Срок хранения заказов в магазине - <b>4 календарных дня</b>.</li>
                        <li class="list__item"><i class="zmdi zmdi-local-shipping"></i>Адреса магазинов можно посмотреть в разделе <b><a href="/about/contact" title="Контакты">Контакты</a></b>.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->



