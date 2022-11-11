<?php

class EditorModel
{
    private $database;
    private $roles = [];

    public function __construct($database)
    {
        $this->database = $database;
    }

    // estado 1 -> sin publicar, 2 -> publicado, 3 -> revision
    public function getContenidos(){
        $sql = "SELECT c.id, c.titulo, c.subtitulo, c.contenido, i.multimedia as imagen, e.descripcion FROM contenido c LEFT JOIN contenido_multimedia i ON c.imagen = i.id LEFT JOIN estado e ON c.estado = e.id";
        return $this->database->query($sql);
    }

    public function getContenidosReportados(){
        $sql = "SELECT r.id as reporte, r.fecha, e.descripcion as estado, c.id as contenido, r.comentarios, u.mail  FROM contenido c LEFT JOIN reportes_editor r ON r.contenido = c.id LEFT JOIN estado e ON r.estado = e.id LEFT JOIN usuarios u ON r.id_contenidista = u.id WHERE c.estado <> 1";
        return $this->database->query($sql);
    }

    public function getContenidosNuevos(){
        $sql = "SELECT c.id, c.titulo, c.subtitulo, c.contenido, i.multimedia as imagen, e.descripcion, c.contenidista FROM contenido c LEFT JOIN contenido_multimedia i ON c.imagen = i.id LEFT JOIN estado e ON c.estado = e.id WHERE c.estado = 1";
        return $this->database->query($sql);
    }

    public function getVerificar() {
        $sql = 'SELECT c.id, c.titulo, c.subtitulo, c.contenido, i.multimedia as imagen, e.descripcion, r.comentarios, u.mail as contenidista FROM contenido c LEFT JOIN contenido_multimedia i ON c.imagen = i.id LEFT JOIN estado e ON c.estado = e.id LEFT JOIN reportes_editor r ON r.contenido = c.id LEFT JOIN usuarios u ON r.id_contenidista = u.id WHERE c.estado = 3';
        return $this->database->query($sql);
    }
}