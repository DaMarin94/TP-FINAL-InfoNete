<?php

class ContenidoEditModel
{

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getContenido() {
        $sql = 'SELECT * FROM contenido';
        return $this->database->query($sql);
    }

    public function getContenidoPorId($id) {
        $sql = "SELECT DISTINCT c.id, c.titulo, c.subtitulo, c.contenido,
                                i.imagen1 as imagen, c.estado, u.mail as contenidista, u.id as c_id, 
                                i.imagen2, i.imagen3, i.audio, i.url FROM contenido c 
                                LEFT JOIN contenido_multimedia i ON c.multimedia = i.id 
                                LEFT JOIN usuarios u ON c.contenidista = u.id 
                                WHERE c.id = '$id'";
        return $this->database->query($sql);
    }

    public function alta($id, $contenidista, $comentario, $estado ) {

        $sql = "UPDATE contenido SET estado = '$estado' WHERE id='$id'";
        $this->database->execute($sql);

        $sqlQ = "SELECT contenido FROM reportes_editor WHERE contenido = '$id'";
        $result = $this->database->query($sqlQ);

        $id_editor = $_SESSION['id_user'];
        $date = $this->getDate();

        if(count($result) > 0){
            $sql2 = "UPDATE reportes_editor SET comentarios = '$comentario', estado = '$estado', fecha = '$date' WHERE contenido = '$id'";
        }else{
            $sql2 = "INSERT INTO reportes_editor (contenido, id_contenidista, id_editor, comentarios, estado, fecha) VALUES ('$id', '$contenidista', '$id_editor', '$comentario', '$estado', '$date')";
        }
        return $this->database->execute($sql2);
    }

    public function getTipos() {
        $sql = "SELECT * FROM estado";
        return $this->database->query($sql);
    }

    public function getReportesEdit($id) {
        $sql = "SELECT comentarios FROM reportes_editor WHERE contenido = '$id'";
        $result = $this->database->query($sql);
        if(count($result) > 0){
            return $result;
        }
    }

    public function getDate(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = new DateTime();
        return $fecha->format("Y-m-d H:i:s");
    }

}