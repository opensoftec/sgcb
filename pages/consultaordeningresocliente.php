<?php
include 'session.php';
if ($Sesion->getIdTipoUsuario() == 4) {
    header('Location: cliente.php');
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
        <link rel="shortcut icon" href="../img/icono_1.jpg" type="image/png"/>
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
                                            <th>Cliente</th>
                                            <th>Caracteristicas Equipo</th>
                                            <th>Antecedentes</th>
                                            <th>Inf. Tecnico</th>
                                            <th>Fecha Entrega</th>
                                            <th>Inf. Pago</th>
                                            <th>Estado Pago</th>
                                            <th>Estado Orden</th>
                                        </tr> 
                                    </thead>

                                    <tbody id="tdetalle">
                                        <?php
                                        $ordenesIngreso = ctrOrdenIngreso::getOrdenesIngresoAdministrador();
                                        foreach ($ordenesIngreso as $ordenIngreso) {
                                            $id = $ordenIngreso->getIdOrdenIngreso();
                                            ?>
                                            <tr>
                                                <td align="center"><?= $ordenIngreso->getNumeroOrden() ?></td>
                                                <td align="center"><?= $ordenIngreso->getFechaIngreso() ?></td>
                                                <td align="center"><?= $ordenIngreso->getNombleCliente() . " " . $ordenIngreso->getApellidoCliente() . "<br>Dir:" . $ordenIngreso->getDireccionCliente() . "<br>Tel." . $ordenIngreso->getTelefonoCliente() ?></td>
                                                <td align="center"><?= $ordenIngreso->getCaracteristicasEquipo() ?></td>
                                                <td align="center"><?= "Antecedente: " .$ordenIngreso->getAntecedenteIngreso(). "<br>Observacion: " .$ordenIngreso->getObservacion() ?></td>
                                                <td align="center"><?= "Tecnico Asignado: " .$ordenIngreso->getNombreTecnico(). " " .$ordenIngreso->getApellidoTecnico(). "<br>Cumplimiento: " .$ordenIngreso->getCumplimiento(). "<br>Obser.Tecnico: " .$ordenIngreso->getObservacionTecnico()?></td>
                                                <td align="center"><?= $ordenIngreso->getFechaEntrega() ?></td>
                                                <td align="center"><?= "Subtotal:" . "$".$ordenIngreso->getSubtotal()."<br>Desc: " .$ordenIngreso->getDescuento()."%" ."<br>Total a Pagar: " . "$".$ordenIngreso->getTotalPagar()?></td>
                                                <?php if ($ordenIngreso->getEstadoPago() == 1) { ?>
                                                    <td align="center"><span class="label label-success" title="Activo">Pagado</span></td>
                                                <?php } else { ?>
                                                    <td align="center"><span class="label label-danger" title="Activo">Por Pagar</span></td>
                                                <?php }?>
                                                
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
                <!-- Inicio del Modal-->
                <div class="container modal" id="mymodal">
                    <div  id="dialog"  title="Ingresó Ordenes de Servicio" >
                        <form class="form-horizontal " role="form" id="frmOrdenIngreso">
                            <input type="hidden" name="idOrdenIngreso" id="_idOrdenIngreso" value="0"/>
                            <input type="hidden" name="opc" id="_opc" value="I"/>
                            <input type="hidden" name="action" id="_action" value="add">
                            <div id="tabs">
                                <ul>
                                    <li><a href="#tabs-1">Ingrese la Informacion...</a></li>
                                </ul>
                                <div id="tabs-1">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Cumplimiento:</label>
                                        <div class="col-xs-4">
                                            <textarea id="_cumplimiento" name="cumplimiento" rows="6" cols="70" disabled="false"></textarea>
                                        </div>
                                       
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Subtotal($):</label>
                                        <div class="col-xs-4">
                                            <input type="number" class="form-control" id="_subtotal" name="subtotal" placeholder="" maxlength="" min="0" required="true" onkeyup="calculo(this.value, _descuento.value);" onclick="limpia(this, _descuento.value);">
                                        </div>
                                        <label class="control-label col-xs-2">Descuento(%):</label>
                                        <div class="col-xs-4">
                                            <input type="number" class="form-control" id="_descuento" name="descuento" placeholder="" maxlength="" min="0" max="100" required="true" onkeyup="validaDescuento(this.value),calculo(_subtotal.value, this.value);" onclick="calculo(_subtotal.value, this.value);" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="control-label col-xs-2">Total a Pagar($):</label>
                                        <div class="col-xs-4">
                                            <input type="number" class="form-control" id="_totalPagar" name="totalPagar" placeholder="" min="0" maxlength="" required="true" disabled="false">
                                        </div>
                                        <label class="control-label col-xs-2">Estado de Pago:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_estadoPago" name="estadoPago" >
                                                <option value="0">Por Pagar</option>
                                                <option value="1">Pagado</option>
                                            </select>
                                        </div>
                                                                       
                                    </div>
                                     
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Estado de Orden:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_estadoOrden" name="estadoOrden" >
                                                <option value="1">Entregado</option>
                                                <option value="2">Pendiente</option>
                                                <option value="3">Garantia</option>
                                                <option value="4">Servicio Externo</option>
                                                <option value="5">Por Entregar</option>
                                                <option value="6">En Revision</option>
                                            </select>
                                        </div> 
                                    </div>

                                      

                                    <div class="form-group center-block">
                                        <button type="button" class="btn btn-toolbar btn-lg active" name="Grabar" id="btngrabar" style="margin-left:260px;"><span class="glyphicon glyphicon-bell"></span> Grabar</button> 
                                        <button type="reset"  class="btn btn-info btn-lg" value="Limpiar" id="btnNuevoR"><span class="glyphicon glyphicon-check"></span> Nuevo</button>
                                        <button type="button" id="btnSalir" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</button> 
                                    </div>
                                </div>								 
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Fin del Modal-->
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
            $('#btnnuevo').click(function () {
                $('#frmOrdenIngreso').each(function () {
                    this.reset();
                });
                $('#_id').val(0);
                $('#_opc').val('I');
                $("#dialog").dialog("open");
                $("#tabs").tabs(
                        {active: 0}
                );
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
                    url: "OrdenIngresoAdministradorOpc.php",
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

            $('#tdatos #tdetalle').on('click', 'a[rel="elim"]', function () {
                var data = $(this).data('id');
                $.ajax({
                    url: "DepartamentoProveedorOpc.php",
                    data: data,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        if (data.ok == true) {
                            alert("Se elimino correctamente");
                            location.reload();
                        } else {
                            alert("ocurrio un error, vuelva a intentar...");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });

            $('#tdatos #tdetalle').on('click', 'a[rel="edit"]', function () {
                var data = $(this).data('id');
                $('#_idOrdenIngreso').val(data.id);
                $.ajax({
                    url: "OrdenIngresoOpc.php",
                    data: data,
                    type: 'POST',
                    dataType: 'json',
                    success: function (json, textStatus, jqXHR) {
                        $('#_opc').val('M');
                        $('#_idOrdenIngreso').val(json.idOrdenIngreso);                 
                        $('#_cumplimiento').val(json.cumplimiento);
                        $('#_subtotal').val(json.subtotal);
                        $('#_descuento').val(json.descuento);
                        $('#_totalPagar').val(json.totalPagar);
                        onload = document.forms['frmOrdenIngreso']['_estadoPago'].value = json.estadoPago;
                        onload = document.forms['frmOrdenIngreso']['_estadoOrden'].value = json.estado;
                        $("#dialog").dialog("open");
                        $("#tabs").tabs({active: 0});
                        return;

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
