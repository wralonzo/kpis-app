<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    
</head>
<body>
<input type="button" id="btnBuscar" value="graficar">
<div class="container" id="contenedor">
<canvas id="myChart"></canvas>
</div>


<script>
var parametrosnombres = [];
var parametrosapellidos= [];
var bgColor=[];
var bgBorde=[];
$('#btnBuscar').click(function() {
    $.post("<?php echo base_url(); ?>kpi/grafica",
        function(data){
            var obj = JSON.parse(data);
            parametrosnombres = [];
            parametrosapellidos= [];            
            bgColor=[];
            bgBorde=[];

            $.each(obj, function(i, item){
                var r = Math.round(Math.random()*255);
                var g = Math.round(Math.random()*255);
                var b = Math.round(Math.random()*255);

                parametrosnombres.push(item.nombreUsuario);
                parametrosapellidos.push(item.apellidoUsuario);

                bgColor.push('rgba('+r+','+g+','+b+', 0.2)');
                bgBorde.push('rgba('+r+','+g+','+b+', 1)');
               
            });

            //eliminamos y creamoos la eetiqueta canvas
            $('#myChart').remove();
            $('#contenedor').append("<canvas id='myChart' ></canvas>");

            var ctx =$('#myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',

            // The data for our dataset
            data: {
                labels: parametrosnombres,
                datasets: [{
                    label: "My First graphic",
                    backgroundColor: bgColor,
                    borderColor: bgBorde,
                    data: parametrosapellidos,
                }]
            },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
        });
    });
});
</script>
    
</body>
</html>