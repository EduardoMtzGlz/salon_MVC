<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{

    public static function index(Router $router){
        session_start(); 
        isAdmin();

        $servicios = Servicio::all();

        $router->render("servicios/index", [
            "nombre"=>$_SESSION["nombre"],
            "servicios"=>$servicios
        ]);
    }

    public static function crear(Router $router){
        session_start(); 
        isAdmin();
        
        $servicio = New Servicio;
        $alertas =[];


        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar(); 

            if(empty($alertas)){
                $servicio->guardar();
                header("Location: /servicios"); 
            }
        }

        $router->render("servicios/crear", [
            "nombre"=>$_SESSION["nombre"], 
            "servicio" =>$servicio, 
            "alertas" =>$alertas
        ]);
        
        
    }

    public static function actualizar(Router $router){
        session_start(); 
        isAdmin();

        $id = validarORedireccionar("/servicios");
        $servicio = Servicio::find($id);
        $alertas =[];
        
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $servicio->sincronizar($_POST); 
            $alertas = $servicio->validar();
            
            if(empty($alertas)){
                $servicio->guardar();
                header("Location: /servicios");
            }
        }       
        
        $router->render("servicios/actualizar", [
            "nombre"=>$_SESSION["nombre"], 
            "servicio" =>$servicio, 
            "alertas" =>$alertas

        ]);
    }

    public static function eliminar(){
        session_start(); 
        isAdmin();
        if($_SERVER["REQUEST_METHOD"] === "POST"){
           $id = $_POST["id"]; 
           $id = filter_var($id, FILTER_VALIDATE_INT);           
            $servicio = Servicio::find($id); 
            $servicio->eliminar(); 
            header("Location: /servicios");
             
        }       
        
    }
}

?>