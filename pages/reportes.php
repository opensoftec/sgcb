<?php
include 'session.php';
if ($Sesion->getIdTipoUsuario() == 4) {
    header('Location: cliente.php');
}if ($Sesion->getIdTipoUsuario() == 3) {
    header('Location: principal.php');
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
        <title>Reportes</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/icono_1.png" type="image/png"/>
        <?php require '../clases/controlador/ctrTipoServicio.php'; ?>
    </head>
    <body>
        <?php include "principaltop.php" ?>
        <article id="content"> 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row-fluid">
                            <div class="span12">
                                <ul class="breadcrumb">
                                    <li><a href="principal.php">Inicio</a><span class="divider"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-offset-2">
                        <div class="lock-screen-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h2>Reporte...</h2>
                                </div>
                                <div class="panel-body">
                                    <form id="Form" class="" name="Form">
                                        <input class="form-control" id="_modo" name="modo" type="hidden" />
                                        <fieldset class="form-group nomargins">
                                            <legend>Ingrese Los Datos</legend>
                                            <div class="container-fluid">
                                                <label class="control-label col-xs-5">Metodo de busqueda :</label>
                                                <div class="controls col-xs-4">
                                                    <input id="_l" type="radio" name="r" value="l"> Tipo de Bien
                                                </div>
                                            </div>
                                            <br>
                                            <div id="reporte1">
                                                <fieldset class="form-group nomargins" id="ordenes">
                                                    <label class="control-label col-xs-3" for="id_ordenes">Seleccione una categoria: </label>
                                                    <div class="controls col-xs-9">
                                                        <select class="form-control" id="id_ordenes" name="orden" >
                                                            <?php
                                                            $tipoProductos = ctrTipoServicio::getTiposServicios();
                                                            foreach ($tipoProductos as $tipoProducto) {
                                                                if ($tipoProducto->getEstado() == true) {
                                                                    ?>
                                                                    <option value="<?= $tipoProducto->getIdTservicio() ?>"><?= $tipoProducto->getDescripcion() ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </fieldset>

                                                <!--                                                <fieldset class="form-group nomargins">
                                                                                                    <label class="control-label col-xs-3" for="id_fechaInicio" id="hide0">Fecha Inicio : </label>
                                                                                                    <div class="controls col-xs-9">
                                                                                                        <input class="form-control" id="id_fechaInicio" name="fechaInicio" type="date" required />
                                                                                                    </div>
                                                                                                </fieldset>
                                                
                                                                                                <fieldset class="form-group nomargins">
                                                                                                    <label class="control-label col-xs-3" for="id_fechaFinal" id="hide1">Fecha Final : </label>
                                                                                                    <div class="controls col-xs-9">
                                                                                                        <input class="form-control" id="id_fechaFinal" name="fechaFinal" type="date" required />
                                                                                                    </div>
                                                                                                </fieldset>-->
                                            </div>
                                            <div id="reporte2">
                                                <input class="form-control" id="_año" name="año" type="text" placeholder="ingrese año" />
                                            </div>
                                        </fieldset>

                                        <div class="panel-body">
                                            <div class="panel" id="respuesta">
                                            </div>
                                        </div>

                                        <div class="panel panel-footer">
                                            <button id="buscar" type="button" class="btn btn-success">
                                                <span class="glyphicon glyphicon-log-in"></span> Buscar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <?php include "./principalfooter.php" ?>
        <script src="../lib/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>


        <script>
                                                $(document).ready(function () {
                                                    $('#reporte1').hide();
                                                    $('#reporte2').hide();
                                                    $('#_modo').val('null');
                                                });
                                                $(function () {
                                                    $('#_a').click(function () {
                                                        $('#_modo').val('a');
                                                        $('#reporte1').hide();
                                                        $('#reporte2').show();
                                                        $('#ordenes').hide();
                                                    });
                                                    $('#_t').click(function () {
                                                        $('#_modo').val('t');
                                                        $('#reporte1').show();
                                                        $('#reporte2').hide();
                                                        $('#ordenes').hide();
                                                    });
                                                    $('#_l').click(function () {
                                                        $('#_modo').val('l');
                                                        $('#reporte1').show();
                                                    });
                                                    $('#buscar').click(function () {
                                                        $('#respuesta').html();
                                                        var data = '';
                                                        if ($('#_modo').val() == 'l') {
                                                            var orden = $('#id_ordenes').val();
                                                            if (orden > 0) {
                                                                    window.open('reportes/report_2.php?orden=' + orden, '_blank');
                                                            } else {
                                                                window.open('reportes/reporte.php?orden=' + orden, '_blank');
                                                            }
                                                        } else if ($('#_modo').val() == 'a') {
                                                            data = $('#_año').val();
                                                            window.open('year.php?year=' + data, '_blank');
                                                        } else {
                                                            window.open('all.php?inicio=' + $('#id_fechaInicio').val() + '&fin=' + $('#id_fechaFinal').val(), '_blank');
                                                        }
                                                    });
                                                });
        </script>

    </body>
</html>
