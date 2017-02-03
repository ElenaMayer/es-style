<div class="about">
    <h1>Контакты</h1>

    <h2>Как с нами связаться</h2>
    <p>Задать вопрос и уточнить интересующую Вас информацию можно несколькими способами:</p>
    <ul class="list list_shopping">
        <li class="list__item">Связаться по телефону <b><?= Yii::app()->params['phone'] ?></b>.</li>
        <li class="list__item">Написать нам в социальных сетях.</li>
        <li class="list__item">Написать нам по электронной почте <b><?= Yii::app()->params['email'] ?></b>.</li>
    </ul>

    <h2>Точка розничной продажи в Новосибирске</h2>
    <div class="contacts">
        Адрес: Мичурина 12 - Ряд №6 Место №184
    </div>
    <div class="contacts">
        Время работы: 10:00 - 19:00 Без выходных
    </div>
    <div id="map_rinok" class="gis_map"></div>
</div>

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