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
        <title>Lista de Departamentos de Proveedores</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/icono_1.jpg" type="image/png"/>
        <?php require '../clases/controlador/ctrDepartamentoProveedor.php'; ?>
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
                                        <img src="../img/menu/departamento.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Lista de Departamentos de Proveedores</h3>
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
                                            <th>C??digo</th>
                                            <th>Descripci??n</th>
                                            <th>Responsable</th>
                                            <th>telefono</th>
                                            <th>Proveedor</th>
                                            <th>Sucursal</th>
                                            <th>Estado</th>
                                            <th>Acci??n</th>
                                        </tr> 
                                    </thead>

                                    <tbody id="tdetalle">
                                        <?php
                                        $departamentosProveedores = ctrDepartamentoProveedor::getDepartamentosProveedores();
                                        foreach ($departamentosProveedores as $departamentoProveedor) {

                                            $id = $departamentoProveedor->getIdDepartamentoProveedor();
                                            ?>
                                            <tr>
                                                <td align="center"><?= $departamentoProveedor->getIdDepartamentoProveedor() ?></td> 
                                                <td align="center"><?= $departamentoProveedor->getDescripcion() ?></td>
                                                <td align="center"><?= $departamentoProveedor->getResponsable() ?></td>
                                                <td align="center"><?= $departamentoProveedor->getTelefono() ?></td>
                                                <td align="center"><?= $departamentoProveedor->getIdProveedor() ?></td>
                                                <td align="center"><?= $departamentoProveedor->getSucursal() ?></td>
                                                <?php if ($departamentoProveedor->getEstado() != true) { ?>
                                                    <td align="center"><span class="label label-danger" title="Inactivo">Inactivo</span></td>
                                                <?php } else { ?>
                                                    <td align="center"><span class="label label-success" title="Activo">Activo</span></td>
                                                <?php } ?>
                                                <td align="center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm">
                                                            <i class="glyphicon glyphicon-log-in"></i> Acci??n
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
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div> 

                <!-- Inicio del Modal-->

                <div class="container modal" id="mymodal">
                    <div id="dialog" title="Mantenimiento de Lista de Departamentos de Proveedores" >
                        <form class="form-horizontal " role="form" id="frmDepartamentoProveedor">
                            <input type="hidden" name="idDepartamentoProveedor" id="_idDepartamentoProveedor" value="0"/>
                            <input type="hidden" name="opc" id="_opc" value="I"/>
                            <input type="hidden" name="action" id="_action" value="add">
                            <div id="tabs">
                                <ul>
                                    <li><a href="#tabs-1">Ingrese la Informacion...</a></li>
                                </ul>
                                <div id="tabs-1">
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Descripcion:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_descripcion" name="descripcion" placeholder="" maxlength="" required="true" pattern="[a-zA-Z??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ,.'-]{1,100}">
                                        </div>


                                        <label class="control-label col-xs-2">Responsable:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_responsable" name="responsable" placeholder="" maxlength="" required="true" pattern="[a-zA-Z??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ,.'-]{1,100}">
                                        </div>



                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Telefono:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_telefono" name="telefono" placeholder="" maxlength="" required="true" pattern="[0-9]{10}">
                                        </div>

                                        <label class="control-label col-xs-2">Proveedor:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_idProveedor" name="idProveedor">
                                                <?php
                                                $proveedores = ctrProveedor::getProveedores();
                                                foreach ($proveedores as $proveedor) {
                                                    if ($proveedor->getEstado() == true) {
                                                        ?>
                                                        <option value="<?= $proveedor->getIdProveedor() ?>"><?= $proveedor->getNombre() . " - " . $proveedor->getSucursal() ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Estado:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_estado" name="estado" >
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

        <footer>

        </footer>

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
                    $('#frmDepartamentoProveedor').each(function () {
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
                $('#frmDepartamentoProveedor').on({
                    submit: function () {
                        var form = $('#frmDepartamentoProveedor');
                        var disabled = form.find(':input:disabled').removeAttr('disabled');
                        var serialized = form.serialize();
                        disabled.attr('disabled','disabled');
                        $.ajax({
                            url: "departamentoproveedoropc.php",
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
                        url: "departamentoproveedoropc.php",
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
                    $('#_idDepartamentoProveedor').val(data.id);
                    $.ajax({
                        url: "departamentoproveedoropc.php",
                        data: data,
                        type: 'POST',
                        dataType: 'json',
                        success: function (json, textStatus, jqXHR) {
                            $('#_opc').val('M');
                            $('#_idDepartamentoProveedor').val(json.idDepartamentoProveedor);
                            $('#_descripcion').val(json.descripcion);
                            $('#_responsable').val(json.responsable);
                            $('#_telefono').val(json.telefono);
                            setSeleccionarItem('_idProveedor', json.idProveedor);
                            $('#_estado').val(json.estado);
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

        </script>
    </body>
</html>
