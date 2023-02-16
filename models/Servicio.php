<?php

namespace Model; 

class Servicio extends ActiveRecord{

    //Base de datos 

    protected static $tabla = "servicios"; 
    protected static $columnasDB= ["id", "nombre", "precio"]; 

    //Creando atributos 
    public $id; 
    public $nombre; 
    public $precio; 
    
    //Creando constructor 

    public function __construct($args =[]){
        $this->id = $args["id"] ?? null; 
        $this->nombre = $args["nombre"] ?? ""; 
        $this->precio = $args["precio"] ?? ""; 
    }

    public function validar()
    {
        if(!$this->nombre){
            self::$alertas["error"][] = "El nombre del servicio no puede estar vacio";
        }
        if(!$this->precio){
            self::$alertas["error"][] = "El precio no puede estar vacio";
        }
        if(!is_numeric($this->precio)){
            self::$alertas["error"][] = "El precio tiene que ser un número";
        }
        return self::$alertas; 
    }
}

?>