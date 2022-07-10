<?php
include 'session.php';
if ($Sesion->getIdTipoUsuario() == 4) {
    header('Location: cliente.php');
}if ($Sesion->getIdTipoUsuario() == 2) {
    header('Location: principal.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Atenciòn Ordenes</title>
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
                                        <img src="../img/menu/piezas.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Atención Ordenes(Tecnico)</h3>
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
                                            <th>Cumplimiento</th>
                                            <th>Det. x Cobrar</th>
                                            <th>Fecha Entrega</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr> 
                                    </thead>

                                    <tbody id="tdetalle">
                                        <?php
                                        $ordenesIngreso = ctrOrdenIngreso::getOrdenesIngresoTecnico($Sesion->getIdUsuario());
                                        foreach ($ordenesIngreso as $ordenIngreso) {
                                            if ($ordenIngreso->getEstadoOrden() == true or ( $ordenIngreso->getEstadoOrden() == false and $Sesion->getIdTipoUsuario() == 1)) {
                                                $id = $ordenIngreso->getIdOrdenIngreso();
                                                ?>
                                                <tr>
                                                    <td align="center"><?= $ordenIngreso->getNumeroOrden() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getFechaIngreso() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getNombleCliente() . " " . $ordenIngreso->getApellidoCliente() . "<br>Dir." . $ordenIngreso->getDireccionCliente() . "<br>Tel." . $ordenIngreso->getTelefonoCliente() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getCaracteristicasEquipo() ?></td>
                                                    <td align="center"><?= "Antecedente:" . $ordenIngreso->getAntecedenteIngreso() . "<br>Observacion:" . $ordenIngreso->getObservacion() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getCumplimiento() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getObservacionTecnico() ?></td>
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
                                                    <td align="center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary btn-sm">
                                                                <i class="glyphicon glyphicon-log-in"></i> 
                                                            </button>
                                                            <?php if ($ordenIngreso->getEstado() == 1) { ?>
                                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" disabled="">
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" >
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a href="#" rel="edit" data-id="action=edit&id=<?= $id ?>">
                                                                            <i class="glyphicon glyphicon-edit" name="atender" ></i> Atender

                                                                        </a>
                                                                    </li>

                                                                </ul>
                                                            <?php } ?>
                                                            <!--                                                        <ul class="dropdown-menu">
                                                                                                                        <li>
                                                                                                                            
                                                                                                                                    <a href="#" rel="edit" data-id="action=edit&id=<?= $id ?>">
                                                                                                                                    <i class="glyphicon glyphicon-edit" name="atender" ></i> Atender
                                                                                                                                 
                                                                                                                            </a>
                                                                                                                        </li>
                                                                                                                        
                                                                                                                    </ul>-->
                                                        </div>
                                                    </td>
                                                </tr> 
                                                <?php
                                            }
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
                                            <textarea id="_cumplimiento" name="cumplimiento" rows="7" cols="70" onfocusout="this.value=this.value.toUpperCase()"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Detalles a Cobrar:</label>
                                        <div class="col-xs-4">
                                            <textarea id="_observacionTecnico" name="observacionTecnico" rows="3" cols="70" onfocusout="this.value=this.value.toUpperCase()"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="form-group">
                                            <label class="control-label col-xs-2">Estado:</label>
                                            <div class="col-xs-4">
                                                <select class="form-control" id="_estado" name="estado" >
                                                    <option value="2">Por Revisar</option>
                                                    <option value="3">Garantia</option>
                                                    <option value="4">Servicio Externo</option>
                                                    <option value="5">Por Entregar</option>
                                                    <option value="6">Revision</option>
                                                    <option value="1"style="display:none">Entregado</option>
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
                console.log(data);
                $.ajax({
                    url: "ordeningresotecnicoopc.php",
                    data: data,
                    type: 'POST',
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        var json = eval("(" + data + ")");
                        if (json.ok == true) {
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
                console.log(data);
                $.ajax({
                    url: "departamentoproveedoropc.php",
                    data: data,
                    type: 'POST',
                    success: function (data, textStatus, jqXHR) {
                        var json = eval("(" + data + ")");
                        if (json.ok == true) {
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
                console.log(data);
                $.ajax({
                    url: "ordeningresoopc.php",
                    data: data,
                    type: 'POST',
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        var json = eval("(" + data + ")");
                        console.log(json);
                        $('#_opc').val('M');
                        $('#_idOrdenIngreso').val(json.idOrdenIngreso);
                        $('#_cumplimiento').val(json.cumplimiento);
                        $('#_observacionTecnico').val(json.observacionTecnico);
                        onload = document.forms['frmOrdenIngreso']['_estado'].value = json.estado;
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
