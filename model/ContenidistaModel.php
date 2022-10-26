<?php

class ContenidistaModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function alta($titulo, $subtitulo, $imagen, $contenido){
        $imagen = '/imagen.png';
        $multimediasql = "INSERT INTO contenido_multimedia (multimedia, multimedia2, multimedia3, multimedia4, multimedia5) VALUES('$imagen', '', '', '', '')";

        $idMultimedia = $this->database->insert($multimediasql);

        $sql = "INSERT INTO contenido (titulo, subtitulo, contenido, imagen) VALUES('$titulo', '$subtitulo', '$contenido', '$idMultimedia')";

        return $this->database->execute($sql);

    }
}