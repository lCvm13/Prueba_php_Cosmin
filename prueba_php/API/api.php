<?php
include 'config.php';
include '../fechas.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



switch (true){
    // Si el método es get (existen datos relacionados la fecha en la bbdd), realizará la consulta para obtener el JSON con los datos de la bbdd
    case $_SERVER['REQUEST_METHOD'] === 'GET':
        $fecha = $_GET["fecha"];
        $stmt = $conn->prepare("SELECT * FROM d_meter WHERE SUBSTRING(datetime,1,10) = '$fecha'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    break;
    case $_SERVER['REQUEST_METHOD'] === 'POST':
        // Si el metodo es POST (no existen datos en la bbdd) se crearán los datos.
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['fecha'])) {
            $fecha = $data['fecha'];
            // Bucle que crea los datos para insertarlos en la base de datos

            // Primer bucle para hacer los datos dos veces por los dos dispositivos: contador1 y contador2
            for($c=1;$c<=2;$c++){
                // Segundo bucle para recorrer las horas del dia
                $energy = 0;
            for($i=0;$i<24;$i++){
                // Tercer bucle para recorrer los minutos de cada hora
                for($j=0;$j<60;$j++){
                    $fecha_actual= new Fecha("",0,$c);
                    if($i<8 || $i>23){
                        // Calculamos la potencia generando un numero aleatorio entre 0 y 100.
                        // Solo se hará si es a partir de las 8 de la mañana, ya que los comienzos de cada día
                        // será 0.
                       $fecha_actual->setPower(0);
                    }
                       $fecha_actual->setEnergy($energy);
                       $energy = $fecha_actual->getEnergy();
                    // Los 15 primeros minutos de cada hora no serán insertados en la tabla de la base de datos.
                    if($j>15){
                    // Creación de la fecha en una cadena de texto para insertarla en la bbdd.
                    $fecha_actual->setFecha("$fecha $i:$j:00");

                    $stmt = $conn->prepare($fecha_actual->insertarBBDD());

                    $stmt->execute();  
                    
                    }
                }
                
            }
        }
            $consulta = $conn->prepare("SELECT * FROM d_meter WHERE SUBSTRING(datetime,1,10) = '$fecha'");
            $consulta->execute();
            $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Datos incompletos']);
        }
    break;
}
