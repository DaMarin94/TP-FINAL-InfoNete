<?php

class NoticiasModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getNoticias()
    {
        $sql = 'SELECT * FROM usuarios';
        return $this->database->query($sql);
    }
}