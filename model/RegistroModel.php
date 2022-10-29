<?php

class RegistroModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function alta($name, $mail, $password, $residencia){

        //CREAMOS UN HASH PARA QUE LA CONTRASEÑA SEA SEGURA
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $rol = $this->getRole();

        //chequeo mail ya existente
        $mailValido = "SELECT * FROM usuarios WHERE mail = '$mail'";

        $mailRes = $this->database->query($mailValido);

        if(count($mailRes) > 0){
            return false;
        }

        $sqlPassword = "INSERT INTO passwords (clave, verificado, vencimiento) VALUES('$hash', '', '0000-00-00 00:00:00')";
        
        $passId = $this->database->insert($sqlPassword);

        $sql = "INSERT INTO usuarios (mail, password,ubicacion, role, estado) VALUES('$mail', '$passId', '$residencia', '$rol', 0)";

        return $this->database->execute($sql);

    }

    private function getRole(){
        //DEFINIMOS EL ROL PARA CUALQUIER USUARIO NUEVO
        return 'lector';
    }

}