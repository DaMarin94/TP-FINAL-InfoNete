<?php

class LoginModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function alta($mail, $password){

        $sql = "SELECT u.mail, u.role, p.clave FROM usuarios u LEFT JOIN passwords p ON u.password = p.id WHERE u.mail = '$mail'";

        $result = $this->database->query($sql);

        $mailAcomparar = $result[0]['mail'];
        $passAcomparar = $result[0]['clave'];
        $roleAcomparar = $result[0]['role'];

            if($mailAcomparar == $mail && $this->getPasswordValido($passAcomparar, $password)){
                $_SESSION['usuario'] = $roleAcomparar;
            }
    }

    public function getPasswordValido($hash, $valid){
    //PASSWORD_VERIFY ES UNA FUNCION QUE COMPARA CONTRASEÑAS CON HASH
        return password_verify($valid, $hash);
    }
}