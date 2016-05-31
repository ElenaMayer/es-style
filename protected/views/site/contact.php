<div class="contact">

    <h1>Точки розничной продажи в Новосибирске</h1>

    <div class="contacts contacts-address">
        <span class="contacts__title">Мичурина 12 - Центральный рынок (1й вещевой павильон)</span>
        <br>
        Ряд №6 Место №184
    </div>
    <div class="contacts contacts-time">
        <span class="contacts__title">Время работы</span>
        <br>
        10:00 - 19:00 Без выходных
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