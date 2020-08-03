<html>
<head>
    <title>Leaflet Realtime</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <style>
        #map {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <div id="map"></div>

<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js"></script>
<script src="<?php echo e(URL::to('/dist/leaflet-realtime.js')); ?>"></script>
</body>
</html>
<script type="text/javascript">
    var map = L.map('map').setView([16.734,96.036], 5);
    realtime = L.realtime('http://localhost:8000/admin/realtime/map/6', {
        interval: 3 * 1000
    }).addTo(map);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

realtime.on('update', function() {
    map.fitBounds(realtime.getBounds(), {maxZoom: 2});
});

</script><?php /**PATH /home/thiri/yoonhanthar/intime-delivery/resources/views/map.blade.php ENDPATH**/ ?>