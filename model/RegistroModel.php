<?php

class RegistroModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function alta($name, $mail, $password, $latitud, $longitud){

        //CREAMOS UN HASH PARA QUE LA CONTRASEÑA SEA SEGURA
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $role = $this->getRole();

        //chequeo mail ya existente
        $mailValido = "SELECT * FROM usuarios WHERE mail = '$mail'";

        $mailRes = $this->database->query($mailValido);

        if(count($mailRes) > 0){
            return false;
        }

        $sqlPassword = "INSERT INTO passwords (clave, verificado, vencimiento) VALUES('$hash', '', '0000-00-00 00:00:00')";
        
        $passId = $this->database->insert($sqlPassword);

        $sql = "INSERT INTO usuarios (nombre, mail, password, latitud, longitud, role, estado) VALUES('$name', '$mail', '$passId', '$latitud','$longitud', '$role', 0)";

        return $this->database->execute($sql);

    }

    private function getRole(){
        //DEFINIMOS EL ROL PARA CUALQUIER USUARIO NUEVO
        return 1;
    }

    public function altaCorreo($email){

        $sql = "update usuarios set estado = 1 where mail = '$email' ";

        return $this->database->execute($sql);
    }

}