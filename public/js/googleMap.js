function loadMap() {

    //opciones del mapa
    var mapOptions = {
        center:new google.maps.LatLng(-34.6706290637543,-58.562643381243575),
        zoom:15,
        panControl: false,
        zoomControl: true,
        scaleControl: false,
        mapTypeControl:false,
        streetViewControl:true,
        overviewMapControl:true,
        rotateControl:true,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };

    //instanciacion del mapa
    var map = new google.maps.Map(document.getElementById("mapa"),mapOptions);

    //click derecho para obtener latitud y longitud
    google.maps.event.addListener(map, "rightclick", function(event) {
        var latitud = event.latLng.lat();
        var longitud = event.latLng.lng();
        document.getElementById("latitud").value = latitud;
        document.getElementById("longitud").value = longitud;
    });

}