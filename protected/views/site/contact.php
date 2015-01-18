<div class="contact">

    <h1>Точки розничной продажи в г. Новосибирске</h1>

    <div class="contacts contacts-address">
        <span class="contacts__title">Мичурина 12 - Центральный рынок</span>
        <br>
        Место №184 (1й вещевой павильон)
    </div>
    <div class="contacts contacts-time">
        <span class="contacts__title">Время работы</span>
        <br>
        10:00 - 19:00 Без выходных
    </div>
    <div id="map_rinok" class="gis_map"></div>

    <div class="contacts contacts-address">
        <span class="contacts__title">Титова 1а/1 - Торговый павильон "Гранит"</span>
        <br>
        Место №70 и №71
    </div>
    <div class="contacts contacts-time">
        <span class="contacts__title">Время работы</span>
        <br>
        9:00 - 21:00 Без выходных
    </div>
    <div id="map_granit" class="gis_map"></div>
</div>

<script src="http://maps.api.2gis.ru/2.0/loader.js?pkg=full" data-id="dgLoader"></script>
<script type="text/javascript">
    var map_rinok;
    var map_granit;
    DG.then(function () {
        map_rinok = DG.map('map_rinok', {
            "center": [55.042049, 82.924407],
            "zoom": 16
        });
        map_granit = DG.map('map_granit', {
            "center": [54.982592, 82.891341],
            "zoom": 16
        });
        DG.marker([55.027069, 82.921052]).addTo(map_rinok);
        DG.marker([55.042049, 82.924407]).addTo(map_rinok);
        DG.marker([54.982592, 82.891341]).addTo(map_rinok);
        DG.marker([55.027069, 82.921052]).addTo(map_granit);
        DG.marker([55.042049, 82.924407]).addTo(map_granit);
        DG.marker([54.982592, 82.891341]).addTo(map_granit);
    });


</script>