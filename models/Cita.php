<?php 

namespace Model;

class Cita extends ActiveRecord{
    //Base de datos
    protected static $tabla = "citas"; 
    protected static $columnasDB = ["id","hora", "fecha", "usuarioId"]; 
    //Atributos para instanciar, crear una nueva cita
    public $id; 
    public $hora; 
    public $fecha;     
    public $usuarioId; 
    //Constructor 
    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null ; 
        $this->hora = $args["hora"] ?? "";
        $this->fecha = $args["fecha"] ?? "";         
        $this->usuarioId = $args["usuarioId"] ?? "";   
    }
}

?>