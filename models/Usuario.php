<?php

namespace Model; 

class Usuario extends ActiveRecord{
    //1. Conexión a la tabla de la Base de datos 
    protected static $tabla = "usuarios"; 
    //2. Normalizacion de los elementos de la tabla de la base de datos, tiene que tener el mismo nombre que cada una de las columnas
    protected static $columnasDB= ["id", "nombre", "apellido", "telefono", "email", "token", "confirmado", "admin", "password"];
    //3.Crear un atributo para cada una de las columnas 
    public $id; 
    public $nombre; 
    public $apellido; 
    public $telefono; 
    public $email; 
    public $token; 
    public $confirmado; 
    public $admin; 
    public $password;
    //4. Crear el constructor de la clase ($this->variable = $args["Donde se gaurdaran"])
    public function __construct($args=[]){
        $this->id =$args["id"] ?? null; 
        $this->nombre =$args["nombre"] ?? ""; 
        $this->apellido=$args["apellido"] ?? ""; 
        $this->telefono =$args["telefono"] ?? ""; 
        $this->email =$args["email"] ?? ""; 
        $this->token =$args["token"] ?? ""; 
        $this->confirmado =$args["confirmado"] ?? 0; //Llevan número, ya que es un booleno 0=false y 1=true
        $this->admin =$args["admin"] ?? 0; 
        $this->password =$args["password"] ?? ""; 
    }

    public function validarCuentaNueva(){
        if(!$this->nombre){
            self::$alertas["error"][] = "Debes añadir un nombre"; 
        }
        if(!$this->apellido){
            self::$alertas["error"][] = "Debes añadir un apellido"; 
        }
        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$alertas["error"][] ="Teléfono no valido o vacio"; 
        }
        if( !(filter_var($this->email, FILTER_VALIDATE_EMAIL))){
            self::$alertas["error"][] = "Debes añadir un email válido"; 
        }

        if(!$this->password){
            self::$alertas["error"][] ="El password es obligatorio"; 
        }

        if(strlen($this->password < 6)){
            self::$alertas["error"][] = "El password debe tener más de 6 caracteres"; 
        }

        return self::$alertas; 

    }

    public function validarLogin(){
        if(!$this->email){
            self::$alertas["error"][] = "El email es obligatorio";
        }

        if(!$this->password){
            self::$alertas["error"][] = "El password es obligatorio";
        }

        return self::$alertas; 
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas["error"][] = "El email es obligatorio";
        }

        return self::$alertas; 
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas["error"][]= "El password es obligatorio"; 
        }
        if(strlen($this->password) < 6){
            self::$alertas["error"][]= "El password debe tener más de 6 carácteres";
        }

        return self::$alertas; 
    }
    //Revisa si el usuario existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1"; 
         
        $resultado = self::$db->query($query); 

        if($resultado->num_rows){
            self::$alertas["error"][] = "El usuario ya esta registrado"; 
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT); 
    }

    public function crearToken(){
        $this->token = uniqid(); 
    }

    public function comprobarPasswordAndVerificado($password){
        $resultado = password_verify($password, $this->password);
        

        if(!$resultado || !$this->confirmado){
            self::$alertas["error"][]= "Password incorrecto o tu cuenta no esta confirmada"; 
        } else{
            return true; 
        }
    }



    
    
}


?>