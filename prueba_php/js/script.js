'use strict';

document.addEventListener("DOMContentLoaded",function () {
    var fecha = document.getElementById("fecha");
    // Seleccionamos la fecha de hoy según canadá para tener el mismo formato que el que pide el input en el html.
    fecha.max = new Date().toLocaleDateString('fr-ca');
    fecha.value = new Date().toLocaleDateString('fr-ca');
    let boton = document.getElementById("boton_calc");

    // Evento click para el boton de calcular en la que hace un ajax para realizar la petición a la api
    // Devolverá un JSON con los cálculos.
    boton.addEventListener("click",function (event) {
        event.preventDefault();
        $.ajax({
        url: "./peticion.php",
        type: "POST",
        data:{fecha:fecha.value}
    })

    .done(function (responseText) {
        // Separamos los datos del JSON segun la columna contador_id para saber qué dispositivo hizo los calculos.
         let respuesta = JSON.parse(responseText);
         let parrafosPower = document.getElementsByClassName("power");
         let parrafosEnergy = document.getElementsByClassName("energy");
         
         let horas = [];
         let power1 =[];
         let energy1 = [];
         let power2 =[];
         let energy2 =[];
        
        let hora_actual="";
         $(respuesta).each((ind,ele) =>{
            if(hora_actual!=ele.datetime.slice(11)){
                horas.push(ele.datetime.slice(11));
            }
             hora_actual = ele.datetime.slice(11);
                if(ele.contador_id==1){
                power1.push(ele.power);
                energy1.push(ele.energy);
            }else{
                power2.push(ele.power);
                energy2.push(ele.energy);
            }
            
         })

        let contenedoresInfo= document.getElementsByClassName("contenedorInfo");
        for(let i=0;i<contenedoresInfo.length;i++){
            contenedoresInfo[i].style="visibility:visible;";
        }
         parrafosPower[0].innerHTML=`Power: ${ Math.round(power1.reduce((a, b) => a + b, 0) / power1.length) }  kW (Avg)`;
         parrafosPower[1].innerHTML=`Power: ${ Math.round(power2.reduce((a, b) => a + b, 0) / power1.length) }  kW (Avg)`;
         parrafosEnergy[0].innerHTML=`Energy: ${energy1[energy1.length-1] }  kWh`;
         parrafosEnergy[1].innerHTML=`Energy: ${energy2[energy2.length-1] }  kWh`;
        
          // Creacion de los graficos por HighChart 
          Highcharts.chart('container', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Datos minutales de potencia'
            },
            xAxis: {
                type:'datetime',
                title: 'Horas',
                categories:horas
            },
            yAxis: {
                title: {
                    text: 'Power'
                }
            },
            series: [{
                name: 'Contador 1',
                data: power1
            },
            {
                name:'Contador 2',
                data: power2
            }]
        });

        Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Datos horarios de energia'
            },
            xAxis: {
                type: 'datetime',
                categories: horas,
                title: 'Horas'
            },
            yAxis: {
                title: {
                    text: 'Energy'
                }
            },
            series: [{
                name: 'Contador 1',
                data: energy1
            },
            {
                name:'Contador 2',
                data: energy2
            }]
        });
    })
    .fail(function (xhr, responseText) {
            alert(xhr.status);
    })
    
        
    });
      })
