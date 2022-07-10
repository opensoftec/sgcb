<?php
require_once '../clases/conexion/DataBase.php';
require_once '../clases/dao/daoReporte.php';
include 'session.php';

$year = $_GET['year'];
$titulo = "ORDENES DE SERVICIO";
$subtitulo = 'En el año : '.$year;
$dao = new daoReporte();
$data = $dao->lista(intval($year));

$cantidades = [];
$meses = [];
foreach ($data as $items){
    $cantidades[] =  intval($items[0]);
    if($items[1]=="January"){
        $meses[] = "Enero";
    }else if ($items[1]=="February"){
        $meses[] = "Febrero";
    }else if ($items[1]=="March"){
        $meses[] = "Marzo";
    }else if ($items[1]=="April"){
        $meses[] = "Abril";
    }else if ($items[1]=="May"){
        $meses[] = "Mayo";
    }else if ($items[1]=="June"){
        $meses[] = "Junio";
    }else if ($items[1]=="July"){
        $meses[] = "Julio";
    }else if ($items[1]=="August"){
        $meses[] = "Agosto";
    }else if ($items[1]=="September"){
        $meses[] = "Septiembre";
    }else if ($items[1]=="October"){
        $meses[] = "Octubre";
    }else if ($items[1]=="November"){
        $meses[] = "Noviembre";
    }else if ($items[1]=="December"){
        $meses[] = "Diciembre";
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
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Grafico Estadistico</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/icono_1.jpg" type="image/png"/>
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
                                        <div class="panel-heading">
                                            <img src="" class="img" width="70">
                                        </div>
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
                        categories:<?php echo json_encode($meses) ?>
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