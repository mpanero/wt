<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["form-first-name"]) || !isset($_POST["form-last-name"]) || !isset($_POST["form-email"]) || !isset($_POST["form-about-yourself"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}
$nombre = $_POST["form-first-name"];
$apellido = $_POST["form-last-name"];
$email = $_POST["form-email"];
$mensaje = $_POST["form-about-yourself"];

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "vps-943718-x.dattaweb.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "info@wintradeagro.com";  // Mi cuenta de correo
$smtpClave = "Wintradeinfo1";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "info@wintradeagro.com";

$mail = new PHPMailer();
$mail->SMTPDebug = SMTP::DEBUG_OFF;
$mail->SMTPDebug = 0; //Alternative to above constant
$mail->isSMTP();  // tell the class to use SMTP
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";


// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Solicitud de contacto"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "{$mensajeHtml} <br /><br />Wintrade Agro<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Wintrade Agro"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$estadoEnvio = $mail->Send(); 
if($estadoEnvio == 1){/*correcto*/
    echo "1"; 
} else {
    echo "0";
}
