<script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
<div style='overflow:hidden;height:90%;width:90%;'>
    <div id='gmap_canvas' style='height:70%;width:90%;'></div>
    <style>#gmap_canvas img {
            max-width: none !important;
            background: none !important
        }</style>
</div>
<script type='text/javascript'>function init_map() {
        var myOptions = {
            zoom: 13,
            center: new google.maps.LatLng(48.85188369999999, 2.2863605999999663),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
        marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(48.85188369999999, 2.2863605999999663)
        });
        infowindow = new google.maps.InfoWindow({content: '<strong>FabLab</strong><br>ECE Paris<br>'});
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);
    }
    google.maps.event.addDomListener(window, 'load', init_map);</script>