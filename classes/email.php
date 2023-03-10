<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email; 
    public $nombre; 
    public $token; 

    public function __construct($nombre, $email, $token){
        $this->email = $email;
        $this->nombre = $nombre; 
        $this->token = $token;  

    }

    public function enviarConfirmacion(){
        //Crear el objeto de email 
        $mail = new PHPMailer(); 
        $mail ->isSMTP(); 
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8b69efc200fbda';
        $mail->Password = '6b3cc644d1e39f';  

        $mail->setFrom("cuentas@salon.com"); 
        $mail->addAddress("cuentas@salon.com", "Salon.com"); 
        $mail->Subject = "Confirma tu cuenta"; 

        //Set html

        $mail->isHTML(TRUE); 
        $mail->CharSet= "UTF-8"; 

        $contenido = "<html>"; 
        $contenido .= "<p>Hola <strong> " . $this->nombre . "</strong> has creado tu cuenta en AppSalony, solo debes confirmarla presionando el siguiente enlace:</p>"; 
        $contenido .= "<p>Presiona aquí <a href='http: //localhost:3000/confirmar-cuenta?token=". $this->token ."'>Confirmar Cuenta</a></p>"; 
        $contenido .= "<p> Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>"; 
        $contenido .= "</html>"; 

        $mail->Body = $contenido; 

        //Enviar el email
        $mail->send(); 
    }

    public function enviarInstrucciones(){
        //Crear el objeto de email 
        $mail = new PHPMailer(); 
        $mail ->isSMTP(); 
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8b69efc200fbda';
        $mail->Password = '6b3cc644d1e39f';  

        $mail->setFrom("cuentas@salon.com"); 
        $mail->addAddress("cuentas@salon.com", "Salon.com"); 
        $mail->Subject = "Reestablece tu Password"; 

        //Set html

        $mail->isHTML(TRUE); 
        $mail->CharSet= "UTF-8"; 

        $contenido = "<html>"; 
        $contenido .= "<p>Hola <strong> " . $this->nombre . "</strong> has solicitado reestablecer tu password en AppSalony, da clic en el siguiente enlace:</p>"; 
        $contenido .= "<p>Presiona aquí: <a href='http: //localhost:3000/recuperar?token=". $this->token ."'>Reestablecer Password</a></p>"; 
        $contenido .= "<p> Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>"; 
        $contenido .= "</html>"; 

        $mail->Body = $contenido; 

        //Enviar el email
        $mail->send(); 
    }
}

?>