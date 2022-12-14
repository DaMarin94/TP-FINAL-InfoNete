<?php

class ContenidistaModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function altaNoticia($titulo, $subtitulo, $idMultimedia, $contenido, $seccion, $edicion, $latitud, $longitud){
        $estado = 1;
        $contenidista = $_SESSION['usuario'][0]['id'];
        $sql1 = "INSERT INTO contenido (titulo, subtitulo, contenido, multimedia, estado, latitud, longitud, contenidista) VALUES('$titulo', '$subtitulo', '$contenido', '$idMultimedia', '$estado', '$latitud', '$longitud', '$contenidista')";
        $noticia = $this->database->insert($sql1);
        $sql2 = "INSERT INTO edicion_seccion_noticia (edicion, seccion, noticia) VALUES('$edicion', '$seccion', '$noticia')";
        return $this->database->execute($sql2);
    }

    public function deleteNoticiaById($idNoticia){
        $sql1 = "DELETE FROM edicion_seccion_noticia WHERE noticia = '$idNoticia'";
        $this->database->execute($sql1);

        $sql2 = "DELETE c, cm FROM contenido c INNER JOIN contenido_multimedia cm
                                                        WHERE c.multimedia = cm.id
                                                        AND c.id = '$idNoticia'";
        return $this->database->execute($sql2);
    }

    public function deleteImagen2FromNoticia($idNoticia){
        $sql = "UPDATE contenido_multimedia cm JOIN contenido c ON cm.id = c.multimedia 
                                               SET cm.imagen2 = '' 
                                               WHERE c.id = '$idNoticia'";
        return $this->database->execute($sql);
    }

    public function deleteImagen3FromNoticia($idNoticia){
        $sql = "UPDATE contenido_multimedia cm JOIN contenido c ON cm.id = c.multimedia 
                                               SET cm.imagen3 = '' 
                                               WHERE c.id = '$idNoticia'";
        return $this->database->execute($sql);
    }

    public function procesarMultimedia()
    {
        $imagen1 = $_FILES['imagen1']['name'];
        if (!is_null($imagen1)) {
            $imagenTmp1 = $_FILES['imagen1']['tmp_name'];
            move_uploaded_file($imagenTmp1, "public/images/" . $imagen1);
        }

        $imagen2 = $_FILES['imagen2']['name'];
        if (!is_null($imagen2)) {
            $imagenTmp2 = $_FILES['imagen2']['tmp_name'];
            move_uploaded_file($imagenTmp2, "public/images/" . $imagen2);
        }

        $imagen3 = $_FILES['imagen3']['name'];
        if (!is_null($imagen3)) {
            $imagenTmp3 = $_FILES['imagen3']['tmp_name'];
            move_uploaded_file($imagenTmp3, "public/images/" . $imagen3);
        }

        $video = null;
        $videoName = null;
        if (!is_null($video)) {
            $videoName = uniqid().".mp4";
            move_uploaded_file($video, "public/multimedia/" . $videoName);
        }

        $audio = $_FILES['audio']['name'];
        $audioName = null;
        if (!empty($audio)){
            $audioName = uniqid() . $audio;
            $audiotmp = $_FILES['audio']['tmp_name'];
            move_uploaded_file($audiotmp, "public/multimedia/" . $audioName);
        }

        $url = $_POST['url'];

        $multimediasql = "INSERT INTO contenido_multimedia (imagen1, imagen2, imagen3, audio, video, url) VALUES('$imagen1', '$imagen2', '$imagen3', '$audioName', '$videoName', '$url')";
        return $this->database->insert($multimediasql);
    }

    public function editarNoticia($idNoticia, $titulo, $subtitulo, $contenido, $seccion, $edicion, $latitud, $longitud){
        $estado = 1;
        $sql = "UPDATE contenido c SET c.titulo = '$titulo', c.subtitulo = '$subtitulo', c.contenido = '$contenido', 
                                       c.latitud = '$latitud', c.longitud = '$longitud', c.estado = '$estado'
                                   WHERE c.id = $idNoticia;";

        if(!empty($_FILES['imagen1']['name'])){
            $imagen1 = $_FILES['imagen1']['name'];
            move_uploaded_file($_FILES['imagen1']['tmp_name'], "public/images/" . $imagen1);
            $sql = "UPDATE contenido_multimedia cm JOIN contenido c ON cm.id = c.multimedia 
                                                   SET cm.imagen1 = '$imagen1' WHERE c.id = '$idNoticia'";
            $this->database->execute($sql);
         }

        if(!empty($_FILES['imagen2']['name'])){
            $imagen2 = $_FILES['imagen2']['name'];
            move_uploaded_file($_FILES['imagen2']['tmp_name'], "public/images/" . $imagen2);
            $sql = "UPDATE contenido_multimedia cm JOIN contenido c ON cm.id = c.multimedia 
                                                   SET cm.imagen2 = '$imagen2' WHERE c.id = '$idNoticia'";
            $this->database->execute($sql);
        }

        if(!empty($_FILES['imagen3']['name'])){
            $imagen3 = $_FILES['imagen3']['name'];
            move_uploaded_file($_FILES['imagen3']['tmp_name'], "public/images/" . $imagen3);
            $sql = "UPDATE contenido_multimedia cm JOIN contenido c ON cm.id = c.multimedia 
                                                   SET cm.imagen3 = '$imagen3' WHERE c.id = '$idNoticia'";
            $this->database->execute($sql);
        }

        if(!empty($_FILES['audio']['name'])){
            $audioName = uniqid() . $_FILES['audio']['name'];
            $audiotmp = $_FILES['audio']['tmp_name'];
            move_uploaded_file($audiotmp, "public/multimedia/" . $audioName);
            $sql = "UPDATE contenido_multimedia cm JOIN contenido c ON cm.id = c.multimedia 
                                                   SET cm.audio = '$audioName' WHERE c.id = '$idNoticia'";
            $this->database->execute($sql);
        }

        if(!empty($_POST['url'])){
            $url = $_POST['url'];
            $sql = "UPDATE contenido_multimedia cm JOIN contenido c ON cm.id = c.multimedia 
                                                   SET cm.url = '$url' WHERE c.id = '$idNoticia'";
            $this->database->execute($sql);
        }

        $sql2 = "UPDATE edicion_seccion_noticia esn SET esn.seccion = '$seccion', esn.edicion='$edicion'
                                                    WHERE esn.noticia = '$idNoticia'";
        $this->database->execute($sql2);
        return $this->database->execute($sql);
    }

    public function altaProducto($nombre, $tipo, $imagen, $precio){
        $sql = "INSERT INTO producto (nombre, tipo, portada, precio) VALUES ('$nombre', '$tipo', '$imagen', '$precio')";
        return $this->database->execute($sql);
    }

    public function altaEdicion($edicion, $precio, $producto, $portada){
        $sql = "INSERT INTO edicion (edicion, precio, producto, portada, fecha) VALUES ('$edicion', '$precio', '$producto', '$portada', NOW())";
        return $this->database->execute($sql);
    }

    public function altaSeccion($edicion, $seccion){
        $sql = "INSERT INTO edicion_seccion (edicion, seccion) VALUES ('$edicion', '$seccion')";
        return $this->database->execute($sql);
    }

    public function getTipos(){
        $sql = "SELECT * FROM tipo";
        return $this->database->query($sql);
    }

    public function getEdiciones(){
        $sql = "SELECT * FROM edicion";
        return $this->database->query($sql);
    }

    public function getProductos(){
        $sql = "SELECT * FROM producto";
        return $this->database->query($sql);
    }

    public function getNoticiasEnBorradorByAutor($idContenidista){
        $sql = "SELECT c.id, c.titulo FROM contenido c JOIN estado e ON c.estado = e.id 
                                      WHERE e.descripcion = 'Sin publicar'
                                      AND c.contenidista = '$idContenidista'";
        return $this->database->query($sql);
    }

    public function getNoticiasRevisadasByAutor($idContenidista){
        $sql = "SELECT c.id, c.titulo, re.comentarios FROM contenido c JOIN estado e ON c.estado = e.id 
                                                                       JOIN reportes_editor re ON re.contenido = c.id 
                                                                       WHERE e.descripcion = 'Revision'
                                                                       AND c.contenidista = '$idContenidista'";
        return $this->database->query($sql);
    }

    public function getNoticiasPublicadasByAutor($idContenidista){
        $sql = "SELECT c.id, c.titulo FROM contenido c JOIN estado e ON c.estado = e.id 
                                          WHERE e.descripcion = 'Publicado'
                                          AND c.contenidista = '$idContenidista'";
        return $this->database->query($sql);
    }

    public function getNombreProductoById($idProducto){
        $sql = "SELECT nombre FROM producto WHERE id = '$idProducto'";
        return $this->database->query($sql);
    }

    public function getNombreEdicionById($idEdicion){
        $sql = "SELECT edicion FROM edicion WHERE id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getEdicionesByProducto($idProducto){
        $sql = "SELECT * FROM edicion WHERE producto = '$idProducto'";
        return $this->database->query($sql);
    }

    public function getSeccionesByEdicion($idEdicion){
        $sql = "SELECT s.descripcion FROM seccion s JOIN edicion_seccion es ON s.id = es.seccion 
                                                    JOIN edicion e ON e.id = es.edicion 
                                                    WHERE e.id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getAjaxSeccionesByEdicion($idEdicion){
        $sql = "SELECT s.id, s.descripcion FROM seccion s JOIN edicion_seccion es ON s.id = es.seccion 
                                                          JOIN edicion e ON e.id = es.edicion 
                                                          WHERE e.id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getSeccionesFaltantesByEdicion($idEdicion){
        $sql = "SELECT *
                FROM seccion s
                WHERE NOT EXISTS (SELECT 1
				                    FROM edicion e JOIN edicion_seccion es ON e.id = es.edicion
                                    WHERE e.id = '$idEdicion'
                                    AND s.id = es.seccion)";
        return $this->database->query($sql);
    }

    public function getDatosNoticia($noticia){
        $sql = "SELECT * FROM contenido WHERE id = '$noticia'";
        return $this->database->query($sql);
    }

    public function getNoticia($idNoticia) {
        $sql = "SELECT c.id, c.titulo, c.subtitulo, c.contenido, c.multimedia, c.latitud, c.longitud, 
                       cm.imagen1, cm.imagen2, cm.imagen3, cm.audio, cm.video, cm.url,
                       e.id as edicionid, e.edicion as edicion,
                       s.id as seccionid, s.descripcion as seccion
                                        FROM contenido c 
                                        JOIN contenido_multimedia cm ON c.multimedia = cm.id
                                        JOIN edicion_seccion_noticia esn ON c.id = esn.noticia
                                        JOIN edicion e ON e.id = esn.edicion
                                        JOIN seccion s ON s.id = esn.seccion
                                        WHERE c.id = '$idNoticia'";
        return $this->database->query($sql);
    }

    public function getMultimediaByNoticia($noticia){
        $sql = "SELECT * FROM contenido_multimedia cm JOIN contenido c ON c.multimedia = cm.id 
                                                      WHERE c.id = '$noticia'";
        return $this->database->query($sql);
    }
}