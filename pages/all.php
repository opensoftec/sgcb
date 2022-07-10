<?php
require_once '../clases/conexion/DataBase.php';
require_once '../clases/dao/daoReporte.php';
include 'session.php';

$inicio = $_GET['inicio'];
$fin = $_GET['fin'];

$titulo = "Grafico General";
$subtitulo = ' Fecha : '.$inicio.' - '.$fin;
$dao = new daoReporte();
$data = $dao->total($inicio, $fin);

$cantidades = [];
$ordenes = [];
foreach ($data as $items){
    $cantidades[] = intval($items[0]);
    $id = $items[1];
    switch ($id){
        case 1:
            echo $ordenes[] = 'Entregada';
            break;
        case 2:
            echo $ordenes[] = 'Por Revisar';
            break;
        case 3:
            echo $ordenes[] = 'Por Garantia';
            break;
        case 4:
            echo $ordenes[] = 'Por Servicio Externo';
            break;
        case 6:
            echo $ordenes[] = 'En Revision';
            break;
        case 5:
            echo $ordenes[] = 'Por Entregar';
            break;
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Grafico de Ordenes de Ingreso</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            <?php include "principaltop.php" ?>
        </header>

        <article id="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-offset-0">
                                <div class="lock-screen-wrapper">
                                    <div class="panel panel-info">
<!--                                        <div class="panel-heading">
                                            <img src="" class="img" width="70">
                                        </div>-->
                                        <div class="panel-body">
                                            <div id="grafica"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <footer>

        </footer>

        <script src="../lib/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/highcharts/highcharts.js"></script>
        <script src="../js/highcharts/exporting.js"></script>

        <script>
            $(function(){
                $('#grafica').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title:{
                        text: '<?php echo $titulo ?>'
                    },
                    subtitle: {
                        text: '<?php echo $subtitulo ?>'
                    },
                    xAxis:{
                        categories:<?php echo json_encode($ordenes) ?>,
                        title:{
                            text: 'Orden'
                        },
                    },
                    yAxis:{
                        title: {
                            text: 'Cantidad'
                        },
                    },
                    tooltip:{
                        valueSuffix:' en total'
                    },
                    legend:{
                        enabled:false
                    },
                    series:[{
                        name: '# Ordenes',
                        data: <?php echo json_encode($cantidades) ?>,
                        dataLabels:{
                            enabled:true
                        }
                    }],
                });
            });
        </script>
    </body>
</html>