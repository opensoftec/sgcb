<?php
include 'session.php';
if($Sesion->getIdTipoUsuario() != 4) {
    header('Location: principal.php');
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Consulta Ordenes</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Listà Descuentos Clientes</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <?php require '../clases/controlador/ctrOrdenIngreso.php'; ?>
        <?php require '../clases/controlador/ctrUsuario.php'; ?>
    </head>
    <body>
        <header>
            <?php include "principaltop.php" ?>
        </header>
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

                        <div class="panel panel-default panel-table panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col col-xs-1">
                                        <img src="../img/menu/cliente.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Consulta Ordenes de Clientes</h3>
                                    </div>                                    
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-xs-6 text-left">
                                        <div class="btn-group">
                                            <a href="javascript:window.location.reload();" class="btn btn-primary">
                                                <i class="glyphicon glyphicon-refresh"> </i>
                                                Actualizar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body" >
                                <table class="table table-hover table-bordered table-responsive table-striped" id="tdatos">
                                    <thead>
                                        <tr>
                                            <th>#Orden</th>
                                            <th>Fecha Ingreso</th>
                                            <th>Tecnico</th>
                                            <th>Caracteristicas Equipo</th>
                                            <th>Antecedentes</th>
                                            <th>Inf. Tecnico</th>
                                            <th>Total a Pagar</th>
                                            <th>Fecha Entrega</th>
                                            <th>Estado Orden</th>
                                        </tr> 
                                    </thead>

                                    <tbody id="tdetalle">
                                        <?php
                                        $ordenesIngreso = ctrOrdenIngreso::getListadoOrdenCliente($Sesion->getIdUsuario());
                                        foreach ($ordenesIngreso as $ordenIngreso) {
                                            $id = $ordenIngreso->getIdOrdenIngreso();
                                            ?>
                                            <tr>
                                                <td align="center"><?= $ordenIngreso->getNumeroOrden() ?></td>
                                                <td align="center"><?= $ordenIngreso->getFechaIngreso() ?></td>
                                                <td align="center"><?= $ordenIngreso->getNombleCliente() . " " . $ordenIngreso->getApellidoCliente() ?></td>
                                                <td align="center"><?= $ordenIngreso->getCaracteristicasEquipo() ?></td>
                                                <td align="center"><?= "Antecedente: " .$ordenIngreso->getAntecedenteIngreso(). "<br>Observacion: " .$ordenIngreso->getObservacion() ?></td>
                                                <td align="center"><?= "Cumplimiento: " .$ordenIngreso->getCumplimiento(). "<br>Obser.Tecnico: " .$ordenIngreso->getObservacionTecnico()?></td>
                                                <td align="center"><?= $ordenIngreso->getTotalPagar() ?></td>
                                                <td align="center"><?= $ordenIngreso->getFechaEntrega() ?></td>
                                                
                                                
                                                
                                                <?php if ($ordenIngreso->getEstado() == 1) { ?>
                                                    <td align="center"><span class="label label-success" title="Activo">Entregado</span></td>
                                                <?php } else if ($ordenIngreso->getEstado() == 2) { ?>
                                                    <td align="center"><span class="label label-danger" title="Activo">Por Revisar</span></td>
                                                <?php } else if ($ordenIngreso->getEstado() == 3) { ?>
                                                    <td align="center"><span class="label label-warning" title="Activo">Garantia</span></td>
                                                <?php } else if ($ordenIngreso->getEstado() == 4) { ?>
                                                    <td align="center"><span class="label label-info" title="Activo">Ser. Ext.</span></td>
                                                <?php } else if ($ordenIngreso->getEstado() == 5) { ?>
                                                    <td align="center"><span class="label label-primary" title="Activo">Por Entregar</span></td>
                                                <?php } else if ($ordenIngreso->getEstado() == 6) { ?>  
                                                    <td align="center"><span class="label label-default" title="Activo">Revision</span></td>
                                                <?php } ?>
                                               
                                            </tr>   
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

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
        <script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
    </body>

    <script>
        
        function limpia(elemento,descuento)
        {
            if(elemento.value == 0){
                elemento.value="0";
            }
            calculo(elemento.value,descuento);
        }

            
        function validaDescuento (descuento){
            if(descuento==''){
                $('#_descuento').val(0);
            }
            if(descuento>100){
                alert("Valor maximo 100%");
                $('#_descuento').val(100);
            } if (descuento<0){
                alert("Valor minimo 0%");
                $('#_descuento').val(0);
            }
        }
        function calculo(subtotal,descuento){
            if(subtotal>0){
                totalDescuento = descuento / 100;
                // Calculo del subtotal
                totalPagar = (subtotal - (subtotal * totalDescuento)).toFixed(2);
                $('#_totalPagar').val(totalPagar);
            }else{
                $('#_subtotal').val(0);
                $('#_totalPagar').val(0);
            }
	}
        
        function limpiarTotalPagar (){
            $('#_totalPagar').val("");
        }
          
        $(function () {
            $('#tdatos').dataTable();
            $("#datepicker").datepicker();
            $("#dialog").dialog({
                height: 540,
                width: 950,
                autoOpen: false,
                show: {
                    effect: "explode",
                    duration: 1000
                },
                hide: {
                    effect: "fold",
                    duration: 1000
                }
            });
           
            $("#btnSalir").click(function () {
                $("#dialog").dialog("close");
            });
        });

        $(function () {
            $('#btngrabar').click(function () {
                var data = $('#frmOrdenIngreso').serialize();
                data = data + "&totalPagar=" + $('#_totalPagar').val();
                $.ajax({
                    url: "ordeningresoadministradoropc.php",
                    data: data,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        if (data.ok == true) {
                            alert("Registro Guardado");
                            location.reload();
                            return;
                        }
                        alert(data.error);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                }); 
            });

          

            function selectInCombo(combo, val)
            {
                for (var indice = 0; indice < document.getElementById(combo).length; indice++)
                {
                    if (document.getElementById(combo).options[indice].text == val)
                        document.getElementById(combo).selectedIndex = indice;
                }
            }

            function setSeleccionarItem($elemento, $comparar) {
                for (var indice = 0; indice < document.getElementById($elemento).length; indice++)
                {
                    if (document.getElementById($elemento).options[indice].text == $comparar)
                    {
                        document.getElementById($elemento).selectedIndex = indice;
                        break;
                    }
                }
            }

            function setSeleccionarItemE($elemento, $comparar) {
                if (document.getElementById($elemento).options[0].value == $comparar) {
                    document.getElementById($elemento).selectedIndex = 0;
                } else {
                    document.getElementById($elemento).selectedIndex = 1;
                }

            }
        });
    </script>
</html>
