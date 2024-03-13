<?php
session_start();
include('fechas.php');

// Realizamos la conexion a la base de datos usada.
$conexion = conectar();
// Url de la API en el servidor localhost
$url = 'http://localhost/prueba_php/API/api.php';

//Realizamos la consulta a la base de datos para saber si la fecha existe en la base de datos
$consultar_fecha = consultar_fecha($conexion,$_POST["fecha"]);
      
switch(true){
    // Si la fecha existe en la base de datos, sacamos los datos directamente de la base de datos
    case $consultar_fecha->num_rows>=1:
        $curl = curl_init($url.'?fecha='.$_POST["fecha"]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $_SESSION["peticion"] = true;
        echo $response;
    break;
    // Si la fecha no se ha calculado anteriormente, hacemos la petición a la API para hacer los calculos.
    
    default:
        $datos = array(
            'fecha' => $_POST["fecha"]
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($datos));
        $response = curl_exec($curl);
        curl_close($curl);
        $_SESSION["peticion"]=true;
        echo $response;
    break;
    
}

?>
