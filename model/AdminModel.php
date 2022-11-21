<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getProductos(){
        $sql = "SELECT p.id, p.nombre, p.portada, p.precio, t.descripcion as tipo FROM producto p join tipo t on p.tipo = t.id WHERE alta = 1";
        return $this->database->query($sql);
    }

    public function getProducto($id){
        $sql = "SELECT * FROM producto WHERE id = '$id'";
        return $this->database->query($sql);
    }

    public function getProductosBaja(){
        $sql = "SELECT p.id, p.nombre, p.portada, p.precio, t.descripcion as tipo FROM producto p join tipo t on p.tipo = t.id WHERE alta = 0";
        return $this->database->query($sql);
    }

    public function bajaProducto($id){
        $returnBol = false;

        $bajaProd = "UPDATE producto
            SET alta = 0
            WHERE id  = '$id'";

        $bajaEdicion = "UPDATE edicion
            SET alta = 0
            WHERE id IN (SELECT e.id FROM producto p JOIN edicion e ON e.producto = p.id WHERE p.id = '$id')";

        $bajaCont = "UPDATE contenido
            SET estado = 4
            WHERE id IN (SELECT esn.noticia FROM producto p JOIN edicion e ON e.producto = p.id JOIN edicion_seccion_noticia esn ON e.id = esn.edicion WHERE p.id = '$id')";

        if($this->database->execute($bajaCont)){
            if($this->database->execute($bajaEdicion)){
                $returnBol = $this->database->execute($bajaProd);
            }
        }

        return $returnBol;

    }

    public function altaProducto($id){
        $returnBol = false;

        $altaProd = "UPDATE producto
        SET alta = 1
        WHERE id = '$id'";

        $altaEdicion = "UPDATE edicion
        SET alta = 1
        WHERE id IN (SELECT e.id FROM producto p JOIN edicion e ON e.producto = p.id WHERE p.id = '$id')";

        $altaCont = "UPDATE contenido
        SET estado = 1
        WHERE id IN (SELECT esn.noticia FROM producto p JOIN edicion e ON e.producto = p.id JOIN edicion_seccion_noticia esn ON e.id = esn.edicion WHERE p.id = '$id')";

        if($this->database->execute($altaCont)){
            if($this->database->execute($altaEdicion)){
                $returnBol = $this->database->execute($altaProd);
            }
        }

        return $returnBol;

    }

    public function editarProducto($id, $nombre, $tipo, $portada){
        $sql = "UPDATE producto SET nombre = '$nombre', tipo = '$tipo', portada = '$portada' WHERE id = '$id';";
        return $this->database->execute($sql);
    }

    public function getTiposProductos(){
        $sql = "SELECT * FROM tipo";
        return $this->database->query($sql);
    }

    public function getEdiciones(){
        $sql = "SELECT e.id, e.edicion, e.precio, DATE_FORMAT(e.fecha, '%d-%m-%Y') as fecha, p.nombre as producto FROM edicion e JOIN producto p ON e.producto = p.id WHERE e.alta = 1";
        return $this->database->query($sql);
    }

    public function getEdicionesBaja(){
        $sql = "SELECT e.id, e.edicion, e.precio, DATE_FORMAT(e.fecha, '%d-%m-%Y') as fecha, p.nombre as producto FROM edicion e JOIN producto p ON e.producto = p.id WHERE e.alta = 0";
        return $this->database->query($sql);
    }

    public function getEdicion($id){
        $sql = "SELECT e.id, e.edicion, e.precio, e.fecha, e.portada, DATE_FORMAT(e.fecha, '%Y-%m-%d') as fecha, p.id as producto FROM edicion e JOIN producto p ON e.producto = p.id WHERE e.id = '$id'";
        return $this->database->query($sql);
    }

    public function editarEdicion($id, $edicion, $fecha, $precio, $producto, $portada) {
        $sql = "UPDATE edicion SET edicion = '$edicion', fecha = '$fecha', portada = '$portada', precio = '$precio', producto = '$producto' WHERE id = '$id';";
        return $this->database->execute($sql);
    }

    public function bajaEdicion($id){
        $returnBol = false;

        $bajaEdicion = "UPDATE edicion SET alta = 0 WHERE id = '$id'";

        $bajaCont = "UPDATE contenido
            SET estado = 4
            WHERE id IN (SELECT esn.noticia FROM edicion e JOIN edicion_seccion_noticia esn ON e.id = esn.edicion WHERE e.id = '$id')";

        if($this->database->execute($bajaCont)){
            $returnBol = $this->database->execute($bajaEdicion);
        }

        return $returnBol;
    }

    public function altaEdicion($id){
        $returnBol = false;

        $altaEdicion = "UPDATE edicion SET alta = 1 WHERE id = '$id'";

        $altaCont = "UPDATE contenido
            SET estado = 3
            WHERE id IN (SELECT esn.noticia FROM edicion e JOIN edicion_seccion_noticia esn ON e.id = esn.edicion WHERE e.id = '$id')";

        if($this->database->execute($altaCont)){
            $this->altaProductoPorEdicion($id);
            $returnBol = $this->database->execute($altaEdicion);
        }

        return $returnBol;

    }

    public function altaProductoPorEdicion($idEdicion){
        $sql = "UPDATE producto SET alta = 1 WHERE id IN (SELECT p.id FROM producto p JOIN edicion e ON e.producto = p.id WHERE e.id = '$idEdicion' AND p.alta = 0);";

        return $this->database->execute($sql);

    }

    public function getContenidos(){
        $sql = "SELECT c.id, c.titulo, c.subtitulo, LEFT(c.contenido,250) as contenido, cm.imagen1 as imagen, e.descripcion as estado, c.estado as estadoId, ed.edicion, s.descripcion as seccion 
                FROM contenido c JOIN contenido_multimedia cm ON c.multimedia = cm.id JOIN estado e ON c.estado = e.id JOIN edicion_seccion_noticia esn ON esn.noticia = c.id 
                JOIN edicion ed ON ed.id = esn.edicion JOIN seccion s ON s.id = esn.seccion WHERE c.estado NOT LIKE 4";
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

        $sql = "SELECT u.id, u.nombre, u.mail, u.estado FROM usuarios u WHERE u.role = 1";

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

    public function detalleContenido($id){
        $sql = "SELECT c.id, c.titulo, c.subtitulo, c.contenido, cm.imagen1 as imagen, e.descripcion as estado, u.nombre as contenidista 
                FROM contenido c JOIN contenido_multimedia cm ON c.multimedia = cm.id JOIN estado e ON e.id = c.estado 
                JOIN usuarios u ON u.id = c.contenidista WHERE c.id ='$id'";
        return $this->database->query($sql);
    }
    public function bajaContenido($id){
        $sql = "UPDATE contenido SET estado = 4 WHERE id = '$id'";
        return $this->database->execute($sql);
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