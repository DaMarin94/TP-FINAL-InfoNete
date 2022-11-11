<?php

class AdminModel
{
    private $database;
    private $roles = [];

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getProductos(){
        $sql = "SELECT p.id, p. nombre, p.portada, t.descripcion as tipo FROM producto p join tipo t on p.tipo = t.id";
        return $this->database->query($sql);
    }

    public function getUsuarios(){
        $usuarios = [];
        $sql = "SELECT * FROM usuarios";

        foreach($this->database->query($sql) as $usuario){
            // para traducir el rol
            $usuario['role'] = $this->getRole($usuario['role']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

    public function getRole($id){
        if(!$this->roles){
            $sql = "SELECT * FROM role";
            $this->roles = $this->database->query($sql);
        }

        foreach($this->roles as $rol){
            if($rol['id'] == $id) {
                return $rol['descripcion'];
            };
        }
    }

    public function getRoles(){
        $sql = "SELECT * FROM role";
        return $this->database->query($sql);
    }

    public function getContenidistas(){
        $sql = "SELECT * FROM usuarios WHERE role = 2";
        return $this->database->query($sql);
    }

    public function altaUsuario($name, $mail, $password, $ubicacion, $role){

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $mailValido = "SELECT * FROM usuarios WHERE mail = '$mail'";

        $mailRes = $this->database->query($mailValido);

        if(count($mailRes) > 0){
            return false;
        }

        $sqlPassword = "INSERT INTO passwords (clave, verificado, vencimiento) VALUES('$hash', '', '')";

        $passId = $this->database->insert($sqlPassword);

        $sql = "INSERT INTO usuarios (nombre, mail, password, ubicacion, role, estado) VALUES('$name', '$mail', '$passId', '$ubicacion', '$role', 0)";

        return $this->database->execute($sql);

    }

    public function getUsuario($id){
        $sql = "SELECT * FROM usuarios u JOIN passwords p ON u.password = p.id WHERE u.id = '$id'";
        return $this->database->query($sql);
    }

    public function editUsuario($id, $name, $mail, $ubicacion, $role){
        $sql = "UPDATE usuarios SET nombre = '$name', mail = '$mail', ubicacion = '$ubicacion', role = '$role' WHERE id = '$id'";
        return $this->database->execute($sql);
    }

    public function deleteUsuario($id){
        $sql = "DELETE FROM usuarios WHERE id = '$id'";
        return $this->database->execute($sql);
    }

}