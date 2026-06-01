<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre  = $_POST['nombre'];
    $correo  = $_POST['correo'];
    $asunto  = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // TU CORREO
        $mail->Username   = 'mitcontabilidad3@gmail.com';

        // CONTRASEÑA DE APLICACIÓN DE GOOGLE
        $mail->Password   = 'oeqs czmj upqw rpie';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->CharSet = 'UTF-8';

        $mail->setFrom(
            'tucorreo@gmail.com',
            'SAS Cloud Technology'
        );

        // Correo que recibirá los mensajes
        $mail->addAddress('mitcontabilidad3@gmail.com');

        // Permite responder directamente al cliente
        $mail->addReplyTo($correo, $nombre);

        $mail->isHTML(true);

        $mail->Subject = "Nuevo contacto web - $asunto";

        $mail->Body = "
        <h2>Nuevo mensaje desde el sitio web</h2>

        <p><strong>Nombre:</strong> {$nombre}</p>

        <p><strong>Correo:</strong> {$correo}</p>

        <p><strong>Asunto:</strong> {$asunto}</p>

        <p><strong>Mensaje:</strong></p>

        <p>{$mensaje}</p>
        ";

        $mail->send();

        echo "
        <script>
            alert('Mensaje enviado correctamente');
            window.location='index.html';
        </script>
        ";

    } catch (Exception $e) {

        echo "
        <script>
            alert('Error al enviar correo: {$mail->ErrorInfo}');
            window.history.back();
        </script>
        ";
    }
}
?>