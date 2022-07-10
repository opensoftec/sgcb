<?php
include 'session.php';
if ($Sesion->getIdTipoUsuario() == 4) {
    header('Location: cliente.php');
}if ($Sesion->getIdTipoUsuario() == 3) {
    header('Location: principal.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Piezas</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/icono_1.png" type="image/png"/>
        <?php require '../clases/controlador/ctrPieza.php'; ?>
        <?php require '../clases/controlador/ctrTipoServicio.php'; ?>
        <?php require '../clases/controlador/ctrMarca.php'; ?>
        <?php require '../clases/controlador/ctrProveedor.php'; ?>
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
                                        <h3>Piezas</h3>
                                    </div>                                    
                                </div>
                                <br>
                                <div class="row">

                                    <div class="col col-xs-6 text-left">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success" id="btnnuevo">
                                                <i class="glyphicon glyphicon-plus-sign"> </i>  
                                                Nuevo Registro
                                            </button>
                                            <a href="javascript:window.location.reload();" class="btn btn-primary">
                                                <i class="glyphicon glyphicon-refresh"> </i>
                                                Actualizar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered table-responsive table-striped" id="tdatos">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Serie</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Tipo</th>
                                            <th>Marca</th>
                                            <th>Proveedor</th>
                                            <th>Observación</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr> 
                                    </thead>

                                    <tbody id="tdetalle">
                                        <?php
                                        $piezas = ctrPieza::getPiezas();
                                        foreach ($piezas as $pieza) {
                                            if ($pieza->getEstado() == true) {
                                                $id = $pieza->getIdPieza();
                                                ?>
                                                <tr>
                                                    <td align="center"><?= $pieza->getIdPieza() ?></td> 
                                                    <td align="center"><?= $pieza->getSerie() ?></td>
                                                    <td align="center"><?= $pieza->getDescripcion() ?></td>
                                                    <td align="center"><?= $pieza->getPrecio() ?></td>
                                                    <td align="center"><?= $pieza->getCantidad() ?></td>
                                                    <td align="center"><?= $pieza->getIdTipoServicio() ?></td>
                                                    <td align="center"><?= $pieza->getIdMarca() ?></td>
                                                    <td align="center"><?= $pieza->getIdProveedor() ?></td>
                                                    <td align="center"><?= $pieza->getObservacion() ?></td>
                                                    <?php if ($pieza->getEstado() != true) { ?>
                                                        <td align="center"><span class="label label-danger" title="Inactivo">Inactivo</span></td>
                                                    <?php } else { ?>
                                                        <td align="center"><span class="label label-success" title="Activo">Activo</span></td>
                                                    <?php } ?>
                                                    <td align="center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary btn-sm">
                                                                <i class="glyphicon glyphicon-log-in"></i> Acción
                                                            </button>
                                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="#" rel="edit" data-id="action=edit&id=<?= $id ?>">
                                                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" rel="elim" data-id="action=elim&id=<?= $id ?>">
                                                                        <i class="glyphicon glyphicon-remove"></i> Eliminar
                                                                    </a>
                                                                </li>

                                                            </ul>
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
                    <div id="dialog" title="Mantenimiento de Piezas" >
                        <form class="form-horizontal " role="form" id="frmPieza">
                            <input type="hidden" name="idPieza" id="_idPieza" value="0"/>
                            <input type="hidden" name="opc" id="_opc" value="I"/>
                            <input type="hidden" name="action" id="_action" value="add">
                            <div id="tabs">
                                <ul>
                                    <li><a href="#tabs-1">Ingrese la Informacion...</a></li>
                                </ul>
                                <div id="tabs-1">
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Serie:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_serie" name="serie" placeholder="" maxlength="" required="true" onfocusout="this.value=this.value.toUpperCase()">
                                        </div>


                                        <label class="control-label col-xs-2">Descripcion:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_descripcion" name="descripcion" placeholder="" maxlength="" required="true" onfocusout="this.value=this.value.toUpperCase()" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,100}">
                                        </div>



                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Precio:</label>
                                        <div class="col-xs-4">
                                            <input type="text" pattern="^[0-9]+([.])?([0-9]+)?$" class="form-control" id="_precio" name="precio" placeholder="" maxlength="" required="true">
                                        </div>

                                        <label class="control-label col-xs-2">Cantidad:</label>
                                        <div class="col-xs-4">
                                            <input type="number" class="form-control" id="_cantidad" name="cantidad" placeholder="" maxlength="" required="true">
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Tipo Producto:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_idTipoProducto" name="idTipoProducto">
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
                                        <label class="control-label col-xs-2">Marca:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_idMarca" name="idMarca">
                                                <?php
                                                $marcas = ctrMarca::getMarcas();
                                                foreach ($marcas as $marca) {
                                                    if ($marca->getEstado() == true) {
                                                        ?> 
                                                        <option value="<?= $marca->getIdMarca() ?>"><?= $marca->getDescripcion() ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>    
                                            </select>
                                        </div> 

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Proveedor:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_idProveedor" name="idProveedor">
                                                <?php
                                                $proveedores = ctrProveedor::getProveedores();
                                                foreach ($proveedores as $proveedor) {
                                                    if ($proveedor->getEstado() == true) {
                                                        ?>
                                                        <option value="<?= $proveedor->getIdProveedor() ?>"><?= $proveedor->getNombre() ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div> 

                                        <label class="control-label col-xs-2">Observación:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_observacion" name="observacion" placeholder="" maxlength="" required="true">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Estado:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_estado" name="estado" <?php if ($Sesion->getIdTipoUsuario() != 1) { ?> disabled="" <?php } ?> >
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div> 
                                    </div>  

                                    <div class="form-group center-block">
                                        <button type="submit" class="btn btn-toolbar btn-lg active" name="Grabar" id="btngrabar" style="margin-left:260px;"><span class="glyphicon glyphicon-bell"></span> Grabar</button> 
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
        <?php include "./principalfooter.php" ?>
        <script src="../lib/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui.min.js" type="text/javascript"></script>

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
                    $('#frmPieza').each(function () {
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
                $('#frmPieza').on({
                    submit: function () {
                        var form = $('#frmPieza');
                        var disabled = form.find(':input:disabled').removeAttr('disabled');
                        var serialized = form.serialize();
                        disabled.attr('disabled', 'disabled');
                        $.ajax({
                            url: "piezaopc.php",
                            data: serialized,
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
                        return false;
                    }
                });

                $('#tdatos #tdetalle').on('click', 'a[rel="elim"]', function () {
                    var data = $(this).data('id');
                    $.ajax({
                        url: "piezaopc.php",
                        data: data,
                        type: 'POST',
                        dataType: 'json',
                        success: function (data, textStatus, jqXHR) {
                            if (data.ok == true) {
                                alert("Se elimino correctamente");
                                location.reload();
                            } else {
                                alert("Ya se encuentra eliminado");
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(errorThrown);
                        }
                    });
                });

                $('#tdatos #tdetalle').on('click', 'a[rel="edit"]', function () {
                    var data = $(this).data('id');
                    $('#_idPieza').val(data.id);
                    $.ajax({
                        url: "piezaopc.php",
                        data: data,
                        type: 'POST',
                        dataType: 'json',
                        success: function (json, textStatus, jqXHR) {
                            $('#_opc').val('M');
                            $('#_idPieza').val(json.idPieza);
                            $('#_serie').val(json.serie);
                            $('#_descripcion').val(json.descripcion);
                            $('#_precio').val(json.precio);
                            $('#_cantidad').val(json.cantidad);
                            setSeleccionarItem('_idTipoProducto', json.idTipoProducto);
                            setSeleccionarItem('_idMarca', json.idMarca);
                            setSeleccionarItem('_idProveedor', json.idProveedor);
                            $('#_observacion').val(json.observacion);
                            setSeleccionarItemE('_estado', json.estado);
                            $("#dialog").dialog("open");
                            $("#tabs").tabs({active: 0});
                            return;
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(errorThrown);
                        }
                    });
                });

            });

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

        </script>
    </body>
</html>
