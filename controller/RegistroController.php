<?php

use PHPMailer\PHPMailer\PHPMailer;

class RegistroController
{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list(){
        $this->alta();
    }

    public function alta(){
        if(!isset($_SESSION["id_user"])) {
            $this->renderer->render("registroForm.mustache");
        }else{
            Redirect::redirect('/');
        }
    }

    public function procesarAlta(){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $latitud = $_POST["latitud"];
        $longitud = $_POST["longitud"];

            if ($this->model->alta($name, $email, $password, $latitud, $longitud)) {
                $this->enviarCorreo($email);
                Redirect::redirect('/login');
            } else {
                $data['error'] = "Error al registrarse";
                $this->renderer->render("registroForm.mustache", $data);
            }
        }

    public function enviarCorreo($email){

        require 'third-party/PHPMailer/src/Exception.php';
        require 'third-party/PHPMailer/src/PHPMailer.php';
        require 'third-party/PHPMailer/src/SMTP.php';

        //progweb2.2022@gmail.com : infonete123

        //Crear una instancia de PHPMailer
        $mail = new PHPMailer();
        //Definir que vamos a usar SMTP
        $mail->IsSMTP();
        //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
        // 0 = off (producción)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug  = 0;
        //Ahora definimos gmail como servidor que aloja nuestro SMTP
        $mail->Host       = 'smtp.gmail.com';
        //El puerto será el 587 ya que usamos encriptación TLS
        $mail->Port       = 587;
        //Definmos la seguridad como TLS
        $mail->SMTPSecure = 'tls';
        //Tenemos que usar gmail autenticados, así que esto a TRUE
        $mail->SMTPAuth   = true;
        //Definimos la cuenta que vamos a usar. Dirección completa de la misma
        $mail->Username   = "progweb2.2022@gmail.com";
        //Introducimos nuestra contraseña de gmail
        $mail->Password   = "hzwcaxhkuxoehazy";
        //Definimos el remitente (dirección y, opcionalmente, nombre)
        $mail->SetFrom('infonete@gmail.com', 'Infonete');
        //Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
        $mail->AddAddress($email, 'usuario');
        //Definimos el tema del email
        $mail->Subject = 'Infonete: Verificacion de correo';
        //Definimos el cuerpo como html
        $mail->isHTML(true);
        //Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
        //$mail->MsgHTML(file_get_contents('correomaquetado.html'), dirname(ruta_al_archivo));
        //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano
        // (también será válida para lectores de pantalla)

        $mensaje = "<div>
                        <h1>Confirmación de correo</h1>
                        <p>Necesitás verificar tu cuenta de infonete antes de poder usarla.</p>
                        <form action='http://localhost/registro/verificarEmail' method='post'>
                           <input type='hidden' name='email' id='email' value='$email'>
                           <button type='submit'>Click acá!</button>
                        </form>  
                   </div>";

        $mail->Body = $mensaje;
        $mail->AltBody = 'This is a plain-text message body';

        //Enviamos el correo
        if(!$mail->Send()) {
            echo "Error: " . $mail->ErrorInfo;
        } else {
            echo "Enviado!";
        }
    }

    public function verificarEmail(){
        $email = $_POST["email"];
        $this->model->altaCorreo($email);
        Redirect::redirect('/login');
    }

}




