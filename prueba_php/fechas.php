<?php
 
include("funciones.php");
// Clases que se crearán a partir de la fecha dada.
// Cada objeto de la clase se insertará en la base de datos para obtenerla con mayor facilidad.
class Fecha{
    private $fecha;
    private $power;
    private $energy;
    private $contador;
    function __construct($fecha,$energy,$contador){
        $this->fecha = $fecha;
        $this->power = rand(0, 100);
        $this->energy = $energy;
        $this->contador = $contador;
    }
    function getFecha (){
        return $this->fecha;
    }

    function setFecha ($fecha){
        return $this->fecha = $fecha;
    }
    
    
    function getPower (){
        return $this->power;
    }

    function setPower ($power){
        return $this->power = $power;
    }

    function getEnergy (){
        return $this->energy;
    }

    function setEnergy ($energy){
        return $this->energy = $energy + ($this->getPower()/60);
    }

    function getContador (){
        return $this->contador;
    }

    function setContador ($contador){
        return $this->contador = $contador;
    }
    
    function insertarBBDD(){
        $contador = $this->getContador();
        $fecha_actual =$this->getFecha();
        $power = $this->getPower();
        $energy = $this->getEnergy();
        return "INSERT INTO d_meter (contador_id,datetime,power,energy) VALUES ($contador, '$fecha_actual' , $power , $energy )";
    }
}