<?php 

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router){
        $alertas = []; 

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST); 

            $alertas=$auth->validarLogin();
            
            
            if(empty($alertas)){
                //Comprobar si el usuario existe
                $usuario = Usuario::where("email", $auth->email); 
                
                if($usuario){
                    //Verificar el password 
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                       //Autenticar el usuario
                       session_start();

                       $_SESSION['id'] = $usuario->id;
                       $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                       $_SESSION['email'] = $usuario->email;
                       $_SESSION['login'] = true;

                       // Redireccionamiento
                       if($usuario->admin === "1") {
                           $_SESSION['admin'] = $usuario->admin ?? null;
                           header('Location: /admin');
                       } else {
                           header('Location: /cita');
                       }
                    }
                }else{
                    Usuario::setAlerta("error", "Usuario no encontrado"); 
                }
            }
        }
        $alertas = Usuario::getAlertas(); 
        $router->render("auth/login", [
            "alertas" => $alertas
        ]); 
    }

    public static function logout(){
        session_start(); 
        $_SESSION=[];  
        header("Location: /");
    }

    public static function olvide(Router $router){
        $alertas= []; 

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST); 
            $alertas=$auth->validarEmail(); 

            if(empty($alertas)){
                //Comprobar el email
                $usuario = Usuario::where("email", $auth->email); 

                if($usuario && $usuario->confirmado === "1"){
                    //Generar un nuevo token
                    $usuario->crearToken();                    $usuario->guardar();
                    //Enviar el email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token); 
                    $email->enviarInstrucciones(); 
                    //Alerta de éxito
                    Usuario::setAlerta("exito", "Revisa tu email");

                }else{
                    Usuario::setAlerta("error", "El usuario no existe o no esta confirmado");
                }
            }
        }

       
        $alertas=Usuario::getAlertas();  

        $router->render("auth/olvide", [
            "alertas" => $alertas
        ]); 


    }

    public static function recuperar(Router $router){
        $alertas= []; 
        $error= false; 

        $token= san($_GET["token"]); 
        
        //Buscar usuario por token
        $usuario = Usuario::where("token", $token); 
        if(empty($usuario)){
            Usuario::setAlerta("error", "Token no válido");
            $error= true; 
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Leer el nuevo password y gaurdarlo 
            $password = New Usuario($_POST); 
            $alertas= $password->validarPassword(); 
            if(empty($alertas)){
                $usuario->password=null; 
                $usuario->password=$password->password; 
                $usuario->hashPassword(); 
                $usuario->token=null; 

                $resultado=$usuario->guardar(); 
                if($resultado){
                    header("Location:/");
                }
            }
        }

        $alertas=Usuario::getAlertas();
        $router->render("auth/recuperar-password", [
            "alertas"=>$alertas, 
            "error" =>$error
        ]);
        
        
    }

    public static function crearCuenta(Router $router){        
        //1. Creando una nueva instancia de usuario, al colocarlo afuera también ayuda a que los datos de un formulario se llenen adcuadamente al cometer un error 
        $usuario= new Usuario; 
        //Alertas vacias

        $alertas= [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Para guardar lo que se lleva en el formulario, se utiliza POST ya que ahí estan en memoria
            $usuario->sincronizar($_POST); 

            //Validar 
            $alertas=$usuario->validarCuentaNueva();  
            
            if (empty($alertas)) {
                //Verficar que el usuario no este registrado 

                $resultado=$usuario->existeUsuario(); 

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas(); 
                }else{
                    //Hashear el password
                    $usuario->hashPassword();
                    

                    //Generar un token único para cada usuario registrado, nuevamente instanciamos el usuario
                    $usuario->crearToken();
                    //Enviar email 
                    $email= new Email($usuario->nombre, $usuario->email, $usuario->token); 
                    //Enviar el email 
                    $email->enviarConfirmacion(); 

                    //Crear el usuario 

                    $resultado= $usuario->guardar(); 
                    if($resultado){
                        header("Location: /mensaje"); 
                    }
                    
                }
                
            }
           
            
        }

        $router->render("auth/crear-cuenta",[
            "usuario" => $usuario, 
            "alertas" => $alertas
        ]);      
    }

    public static function mensaje(Router $router){
        $router->render("auth/mensaje"); 
    }

    public static function confirmar(Router $router){
        $alertas =[]; 
        //Metodo GET para obtener la información del token a validar
        $token= san($_GET["token"]); 

        $usuario = Usuario::where("token", $token); 
        
        if(empty($usuario)){
            //Mostrar mensaje de error
            Usuario::setAlerta("error", "Token No Válido"); 
        }else{
            //Mostrar mensaje de confirmado
            $usuario->confirmado = 1; 
            $usuario->token = null; 
            $usuario->guardar();
            Usuario::setAlerta("exito", "Has confimardo tu cuenta correctamente"); 
        }
        //Obtener alertas
        $alertas = Usuario::getAlertas(); 
        //Renderizar la vista
        $router->render("auth/confirmar-cuenta", [
            "alertas" => $alertas
        ]); 
    }
}

?>