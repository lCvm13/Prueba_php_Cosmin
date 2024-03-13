<?php
// Iniciamos sesión para el usuario
session_start();

//incluimos archivo de funciones

include("funciones.php");

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Prueba_php Cosmin Movila</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="./css/estilo.css">
        
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <aside>
                <form action="peticion.php" id="formulario_peticion" method="POST">
                    <label for="etiqueta_fecha" class="form-label">Date:</label>
                    <input type="date" id="fecha" name="fecha" value="2024-03-12" max="2024-03-15" class="form-control">
                    <button id="boton_calc" type="submit" class="btn btn-primary">Calculate</button>
                </form>
        
                <div class="contenedorInfo">
                        <h3>CONTADOR 1</h3>
                        <p class="power">Power:  kW</p>
                        <p class="energy">Energy:  kWh</p>
                        
                </div>
                <div class="contenedorInfo">   
                        <h3>CONTADOR 2</h3>
                        <p class="power">Power: <?php ?> kW</p>
                        <p class="energy">Energy: <?php  ?> kWh</p>
                </div>
            </aside>
            <section>
                <div id="container"></div>
                <div id="container2"></div>
            </section>
            
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="./js/script.js"></script>
    </body>
</html>



<?php




/*
    $curl = curl_init();
    $url = 'http://localhost/prueba_php/API/api.php';
    $usuarios = array(
        'nombre' => 'Segundo nuevo usuario'
    );
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($usuarios));
    $response = curl_exec($curl);
    curl_close($curl);
    var_dump($response);

*/
    //<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
?>