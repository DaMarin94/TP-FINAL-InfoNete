<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getProductos(){
        $sql = "SELECT p.id, p. nombre, p.portada, t.descripcion as tipo FROM producto p join tipo t on p.tipo = t.id";
        return $this->database->query($sql);
    }

    public function getUsuarios(){
        $sql = "SELECT u.id, u.nombre, u.mail, u.latitud, u.longitud, u.estado, r.descripcion as role FROM usuarios u JOIN role r ON u.role = r.id";
        return $this->database->query($sql);
    }

    public function getRoles(){
        $sql = "SELECT * FROM role";
        return $this->database->query($sql);
    }

    public function getContenidistasReporte(){
        $sql = "SELECT * FROM usuarios WHERE role = 2";
        return $this->database->query($sql);
    }

    public function getClientesReporte(){
        $clientes = [];

        $sql = "SELECT u.id, u.nombre, u.mail, u.estado
                FROM usuarios u WHERE u.role = 1";

        $result = $this->database->query($sql);

        if($result){
            foreach($result as $cliente){
                $cliente += [ "producto" => $this->getSubsCliente($cliente['id']) ];
                $cliente += [ "edicion" => $this->getComprasCliente($cliente['id']) ];
                array_push($clientes, $cliente);
            }
        }

        return $clientes;
    }

    private function getSubsCliente($clienteId) {
        $subs = '';
        $sql = "SELECT p.nombre as producto FROM suscripcion s JOIN producto p ON s.producto_id = p.id JOIN usuarios u ON u.id = s.usuario_id WHERE u.id = '$clienteId'";

        if(count($this->database->query($sql)) > 0){
            foreach($this->database->query($sql) as $sub){
                $subs .= $sub['producto'].', ';
            };
            $subs = rtrim($subs,", ");
        }

        return $subs;
    }

    private function getComprasCliente($clienteId) {

        $compra = '';
        $sql = "SELECT e.edicion as compra FROM compra c JOIN edicion e ON c.edicion_id = e.id JOIN usuarios u ON u.id = c.usuario_id WHERE u.id = '$clienteId'";

        if(count($this->database->query($sql)) > 0) {
            foreach($this->database->query($sql) as $edicion){
                $compra .= $edicion['compra'].', ';
            };
            $compra = rtrim($compra,", ");
        }

        return $compra;
    }

    public function getProductosReporte() {
        $productos = [];
        $sql = "SELECT p.id, p.nombre, t.descripcion as tipo, count(s.producto_id) as sub_cant 
                FROM suscripcion s RIGHT JOIN producto p ON s.producto_id = p.id JOIN tipo t ON p.tipo = t.id GROUP BY p.id";

        foreach($this->database->query($sql) as $producto){
            $producto += [ "edicion" => $this->getEdicionesReporte($producto['id']) ];
            array_push($productos, $producto);
        }

        return $productos;
    }

    private function getEdicionesReporte($productoId) {
        $sql = "SELECT COUNT(c.edicion_id) as compras, e.edicion as nom_edicion, e.precio,DATE_FORMAT(e.fecha, '%d-%m-%Y') as fecha FROM producto p JOIN edicion e ON e.producto = p.id LEFT JOIN compra c ON e.id = c.edicion_id WHERE p.id = '$productoId' GROUP BY e.id";
        return $this->database->query($sql);
    }

    public function altaUsuario($name, $email, $password, $latitud, $longitud, $role){

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $mailValido = "SELECT * FROM usuarios WHERE mail = '$email'";

        $mailRes = $this->database->query($mailValido);

        if(count($mailRes) > 0){
            return false;
        }

        $sqlPassword = "INSERT INTO passwords (clave, verificado, vencimiento) VALUES('$hash', '', '')";

        $passId = $this->database->insert($sqlPassword);

        $sql = "INSERT INTO usuarios (nombre, mail, password, latitud, longitud, role, estado) VALUES('$name', '$email', '$passId', '$latitud', '$longitud', '$role', 0)";

        return $this->database->execute($sql);

    }

    public function getUsuario($id){
        $sql = "SELECT * FROM usuarios u JOIN passwords p ON u.password = p.id WHERE u.id = '$id'";
        return $this->database->query($sql);
    }

    public function editUsuario($id, $name, $mail, $latitud, $longitud, $role){
        $sql = "UPDATE usuarios SET nombre = '$name', mail = '$mail', latitud = '$latitud', longitud = '$longitud' role = '$role' WHERE id = '$id'";
        return $this->database->execute($sql);
    }

    public function deleteUsuario($id){
        $sql = "DELETE FROM usuarios WHERE id = '$id'";
        return $this->database->execute($sql);
    }

}