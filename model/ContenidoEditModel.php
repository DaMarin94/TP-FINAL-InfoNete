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

        $sql = "SELECT c.id, c.titulo, c.subtitulo, c.contenido, i.multimedia as imagen, c.estado, u.mail as contenidista, u.id as c_id FROM contenido c LEFT JOIN contenido_multimedia i ON c.imagen = i.id LEFT JOIN usuarios u ON c.contenidista = u.id WHERE c.id = '".$id."' ";
        return $this->database->query($sql);
    }

    public function alta($id, $contenidista, $comentario, $estado ) {

        $sql = "UPDATE contenido SET estado = '$estado' WHERE id='$id'";
        $this->database->execute($sql);

        $id_editor = $_SESSION['id_user'];
        $sql2 = "INSERT INTO reportes_editor (contenido, id_contenidista, id_editor, comentarios, estado) VALUES ('$id', '$contenidista', '$id_editor', '$comentario', '$estado')";
        return $this->database->execute($sql2);
    }
}