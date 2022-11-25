function muestraSeccionesPorEdicion(edicion) {

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("seccionesPorEdicion").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","/contenidista/ajaxSeccionesPorEdicion?edicion="+edicion,true);
    xmlhttp.send();
}