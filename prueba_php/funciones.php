<?php
// Función que realiza la conexión a la base de datos usada para el proyecto.

function conectar(){
    global $conexion;
    $conexion = new mysqli("localhost","root","","prueba_php");
    return $conexion;
}

// Función que consulta si existe algun registro en la base de datos con la fecha que ha escogido el usuario.

function consultar_fecha($conexion,$fecha){
    $resultado = $conexion->query("SELECT * FROM d_meter WHERE SUBSTRING(datetime,1,10) = '$fecha'");
    return ($resultado);
}

// Funcion para cambiar de url.

function volver($url){
    header("Location: $url");
}
?>