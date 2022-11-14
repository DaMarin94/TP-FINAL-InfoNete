function muestraSecciones(edicion) {
    if (edicion=="") {
        document.getElementById("secciones").innerHTML="";
        return;
    }
    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("secciones").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","/contenidista/ajaxSecciones?edicion="+edicion,true);
    xmlhttp.send();
}
