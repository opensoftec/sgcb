<?php
include 'session.php';
if ($Sesion->getIdTipoUsuario() == 4) {
    header('Location: cliente.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Ordenes de Ingreso</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Listà Descuentos Clientes</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/modal.css" rel="stylesheet" type="text/css"/>
        <link href="../css/chosen.css" rel="stylesheet"/>
        <link href="../css/bootstrap-choosen.css" rel="stylesheet" />
        <link rel="shortcut icon" href="../img/icono_1.png" type="image/png"/>
        <?php require '../clases/controlador/ctrOrdenIngreso.php'; ?>
        <?php require '../clases/controlador/ctrUsuario.php'; ?>
        <?php require '../clases/controlador/ctrTipoUsuario.php'; ?>

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
                                        <img src="../img/menu/orden.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Ordenes de Ingreso al Sistema</h3>
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
                            <div class="panel-body" >
                                <table class="table table-hover table-bordered table-responsive table-striped" id="tdatos">
                                    <thead>
                                        <tr>
                                            <th>#Orden</th>
                                            <th>Fecha Ingreso</th>
                                            <th>Cliente</th>
                                            <th>Caracteristicas Equipo</th>
                                            <th>Antecedentes</th>
                                            <th>Observacion</th>
                                            <th>Fecha Entrega</th>
                                            <th>Tecnico</th>
                                            <th>Estado</th>
                                            <?php if ($Sesion->getIdTipoUsuario() == 1) { ?>
                                                <th>Reg. Eliminado</th>
                                            <?php } ?>
                                            <th>Acción</th>
                                        </tr> 
                                    </thead>

                                    <tbody id="tdetalle">
                                        <?php
                                        $ordenesIngreso = ctrOrdenIngreso::getOrdenesIngreso();
                                        foreach ($ordenesIngreso as $ordenIngreso) {
                                            if ($ordenIngreso->getEstadoOrden() == true or ( $ordenIngreso->getEstadoOrden() == false and $Sesion->getIdTipoUsuario() == 1)) {
                                                $id = $ordenIngreso->getIdOrdenIngreso();
                                                ?>
                                                <tr>

                                                    <td align="center"><?= $ordenIngreso->getNumeroOrden() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getFechaIngreso() ?></td>
                                                    <td align="center"><?= "Nombre: " . $ordenIngreso->getNombleCliente() . " " . $ordenIngreso->getApellidoCliente() . "<br>Dir." . $ordenIngreso->getDireccionCliente() . "<br>Tel." . $ordenIngreso->getTelefonoCliente() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getCaracteristicasEquipo() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getAntecedenteIngreso() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getObservacion() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getFechaEntrega() ?></td>
                                                    <td align="center"><?= $ordenIngreso->getNombreTecnico() . " " . $ordenIngreso->getApellidoTecnico() ?></td>
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

                                                    <?php
                                                    if ($Sesion->getIdTipoUsuario() == 1) {
                                                        if ($ordenIngreso->getEstadoOrden() == 1) {
                                                            ?>
                                                            <td align="center"><span class="label label-success" title="Registro Eliminado">Activo</span></td>
                                                        <?php } else { ?>
                                                            <td align="center"><span class="label label-danger" title="Registro No Eliminado" >Eliminado</span> </td>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                    <td align="center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary btn-sm">
                                                                <i class="glyphicon glyphicon-log-in"></i> 
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
                                                                    <a href="reportes/report.php?num=<?= $id ?>" target="_block">
                                                                        <i class="glyphicon glyphicon-import"></i> Imprimir
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

                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <ul>
                                <li><a href="#">Ingrese la Informacion...</a></li>
                            </ul>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal " role="form" id="frmOrdenIngreso">
                                <input type="hidden" name="idOrdenIngreso" id="_idOrdenIngreso" value="0"/>
                                <input type="hidden" name="opc" id="_opc" value="I"/>
                                <input type="hidden" name="action" id="_action" value="add">

                                <div class="form-group">
                                    <label class="control-label col-xs-2">Numero Orden:</label>
                                    <div class="col-xs-4">
                                        <?php $ctrOrdenIngreso = new ctrOrdenIngreso(); ?>
                                        <input type="text" class="form-control" id="_numeroOrden" name="numeroOrden" placeholder="" maxlength="" required="true" value="<?= $ctrOrdenIngreso->getNumeroOrden(); ?>">
                                    </div>

                                    <label class="control-label col-xs-2">Fecha Ingreso:</label>
                                    <div class="col-xs-4">
                                        <input type="date" class="form-control" id="_fechaIngreso" name="fechaIngreso" placeholder="" maxlength="" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-2">Cliente:</label>
                                    <div class="col-xs-4">
                                        <select  class="form-control" id="_idCliente" name="idCliente">
                                            <?php
                                            $usuarios = ctrUsuario::getUsuariosC();
                                            foreach ($usuarios as $usuario) {
                                                if ($usuario->getEstado() == true) {
                                                    ?>
                                                    <option value="<?= $usuario->getIdUsuario() ?>"><?= $usuario->getNombre() . " " . $usuario->getApellido() ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <label class="control-label col-xs-2">Caracteristicas Equipo:</label>
                                    <div class="col-xs-4">
                                        <textarea class="form-control" id="_caracteristicasEquipo" name="caracteristicasEquipo" rows="6" cols="53" required="required" onfocusout="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-2">Antecedente:</label>
                                    <div class="col-xs-4">
                                        <textarea class="form-control" id="_antecedentes" name="antecedentes" rows="4" cols="52" required="required" onfocusout="this.value=this.value.toUpperCase()"></textarea>
                                    </div>

                                    <label class="control-label col-xs-2">Observacion:</label>
                                    <div class="col-xs-4">
                                        <textarea class="form-control" id="_observacion" name="observacion" rows="4" cols="53" required="required" onfocusout="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-2">FechaEntrega:</label>
                                    <div class="col-xs-4">
                                        <input type="date" id="_fechaEntrega" name="fechaEntrega" class=”required” required="required">
                                    </div>

                                    <label class="control-label col-xs-2">Tecnico:</label>
                                    <div class="col-xs-4">
                                        <select class="form-control" id="_idTecnico" name="idTecnico">
                                            <?php
                                            $usuarios = ctrUsuario::getTecnicosAdministradores();
                                            foreach ($usuarios as $usuario) {
                                                if ($usuario->getEstado() == true) {
                                                    ?>
                                                    <option value="<?= $usuario->getIdUsuario() ?>"><?= $usuario->getNombre() . " " . $usuario->getApellido() ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                            $usuarios = ctrUsuario::getTecnicos();
                                            foreach ($usuarios as $usuario) {
                                                if ($usuario->getEstado() == true) {
                                                    ?>
                                                    <option value="<?= $usuario->getIdUsuario() ?>"><?= $usuario->getNombre() . " " . $usuario->getApellido() ?></option>
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
                                            <option value="2">Por Revisar</option>
                                            <option value="3">Garantia</option>
                                            <option value="4">Servicio Externo</option>
                                            <option value="5">Por Entregar</option>
                                            <option value="6">En Revision</option>
                                            <option value="1">Entregado</option>
                                        </select>
                                    </div> 
                                  
                                </div>
                                <div class="form-group center-block">
                                    <button type="submit" class="btn btn-toolbar btn-lg active" name="Grabar" id="btngrabar" style="margin-left:260px;"><span class="glyphicon glyphicon-bell" ></span> Grabar</button> 
                                    <button type="reset"  class="btn btn-info btn-lg" value="Limpiar" id="btnNuevoR"><span class="glyphicon glyphicon-check"></span> Nuevo</button>
                                    <button type="button" id="btnSalir" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Inicio del Modalcliente-->
                <div class="container modal" id="mymodal">
                    <div id="dialog" title="Mantenimiento de usuarios">
                        <form class="form-horizontal " role="form" id="frmUsuario">
                            <input type="hidden" name="idUsuario" id="_idUsuario" value="0"/>
                            <input type="hidden" name="opc" id="_opc" value="I"/>
                            <input type="hidden" name="action" id="_action" value="add">
                            <div id="tabs">
                                <ul>
                                    <li><a href="#tabs-1">Ingrese la Informacion...</a></li>
                                </ul>
                                <div id="tabs-1">
                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Cedula:</label>
                                        <div class="col-xs-4">
                                            <input type="text"  class="form-control" id="_cedula" name="cedula" placeholder="Ingrese solo numeros"  required="true" pattern="[0-9]{10}" onkeypress="return controltag(event)" onkeyup="generaContraseña(this.value);">
                                        </div>
                                        <label class="control-label col-xs-2">Nombre:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_nombre" name="nombre" placeholder="Ingrese solo letras" maxlength="" required="true" onfocusout="this.value=this.value.toUpperCase()" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,100}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Apellido:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_apellido" name="apellido" placeholder="Ingrese solo letras" maxlength="" required="true" onfocusout="this.value=this.value.toUpperCase()" required="true" onfocusout="this.value=this.value.toUpperCase()" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,100}">
                                        </div>
                                        <label class="control-label col-xs-2">Direccion:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_direccion" name="direccion" placeholder="Ingrese la direccion" required="true" onfocusout="this.value=this.value.toUpperCase()">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Telefono:</label>
                                        <div class="col-xs-4">
                                            <input type="tel"  class="form-control" id="_telefono" name="telefono" placeholder="Ingrese solo numeros"  required="true" pattern="[0-9]{10}">
                                        </div>
                                        <!-- Aqui bloquear-->
                                        <label class="control-label col-xs-2">Usuario:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" placeholder="Eje: jholguinm" id="_usuario" name="usuario"  required="true" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Contraseña:</label>
                                        <div class="col-xs-4">
                                            <input type="password" class="form-control" id="_contrasena" name="contrasena" placeholder="Ingrese la clave" maxlength="" required="true" disabled>
                                        </div>
                                        <label class="control-label col-xs-2">Tipo:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_idTipoUsuario" name="idTipoUsuario" <?php if ($Sesion->getIdTipoUsuario() == 2 or $Sesion->getIdTipoUsuario() == 3 or $Sesion->getIdTipoUsuario() == 5) { ?> disabled="" <?php } ?>>
                                                <?php
                                                $tipos = ctrTipoUsuario::getTipoUsuarios();
                                                foreach ($tipos as $tipo) {
                                                    if ($tipo->getEstado() == true) {
                                                        ?>
                                                        <option value="<?= $tipo->getIdTipoUsuario() ?>" <?php if (($Sesion->getIdTipoUsuario() == 2 or $Sesion->getIdTipoUsuario() == 3 or $Sesion->getIdTipoUsuario() == 5) and $tipo->getIdTipoUsuario() == 4) { ?> selected="" <?php } ?>><?= $tipo->getDescripcion() ?></option>
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
                                            <select class="form-control" id="_estado" name="estado" <?php if ($Sesion->getIdTipoUsuario() != 1) { ?> disabled="" <?php } ?> >
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                        <label class="control-label col-xs-2">Correo:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="_correo" name="correo"  required="true" placeholder="Ingrese su correo">
                                        </div>
                                    </div>

                                    <div class="form-group center-block">
                                        <button type="submit" class="btn btn-toolbar btn-lg active" name="Grabar" id="btngrabar" style="margin-left:260px;"><span class="glyphicon glyphicon-bell"></span> Grabar</button> 
                                        <button type="button" id="btnSalirModal" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove"></span> Cerrar</button> 
                                    </div>
                                </div>								 
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Fin del Modalcliente-->
        </article>
        <footer>
        </footer>
        <script src="../lib/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../js/Chosen/chosen.jquery.js" type="text/javascript"></script>
    </body>

    <script>

        function generaContraseña(cedula) {
            inicio = 0,
            fin    = 4,
            subCadena = cedula.substring(inicio, fin);
            $('#_contrasena').val(subCadena);
        }
        function controltag(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==8) return true;
            else if (tecla==0||tecla==9)  return true;
            // patron =/[0-9\s]/;// -> solo letras
            patron =/[0-9\s]/;// -> solo numeros
            te = String.fromCharCode(tecla);
            return patron.test(te);
        }
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName("close")[0];
        $(document).ready(function () {
            //nuevo
            //
//              $('#_idCliente').chosen({width: "85%"});
//                    $('#_idTecnico').chosen({width: "100%"});
                $('#_idCliente').parent('div').append('<button type="button" class="btn btn-success" id="btnnuevoModal"><i class="glyphicon glyphicon-plus-sign"></i></button>');
           //Aqui estaba el choosen
            //;
        });
        //codigo nuevo
        function validaCedula(cedula) {
//                if (e.keyCode === 13 && !e.shiftKey) {
            array = cedula.split("");
            num = array.length;
            if (num == 10)
            {
                total = 0;
                digito = (array[9] * 1);
                for (i = 0; i < (num - 1); i++)
                {
                    mult = 0;
                    if ((i % 2) != 0) {
                        total = total + (array[i] * 1);
                    }
                    else
                    {
                        mult = array[i] * 2;
                        if (mult > 9)
                            total = total + (mult - 9);
                        else
                            total = total + mult;
                    }
                }
                decena = total / 10;
                decena = Math.floor(decena);
                decena = (decena + 1) * 10;
                final = (decena - total);
                if ((final == 10 && digito == 0) || (final == digito)) {
//                            alert( "La c\xe9dula ES v\xe1lida!!!" );
                    return true;
                }
                else
                {
                    alert("la cedula no es valida");
                    return false;
                }
            }
            else
            {
                alert("la cedula no debe tener menos ni mas de 10 digitos");
                return false;
            }
//                }    


        }
        //fin de codigo nuevo
        $(function () {
            $('#tdatos').dataTable();
            $("#datepicker").datepicker();
            //nuevo
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
            $('#btnnuevoModal').click(function () {
                $('#frmUsuario').each(function () {
                    this.reset();
                });
                $('#_id').val(0);
                $('#_opc').val('I');
                $("#dialog").dialog("open");
                $("#tabs").tabs(
                        {active: 0}
                );
            });
            $("#btnSalirModal").click(function () {
                $("#dialog").dialog("close");
               
            });
            //fin nuevo
            $('#btnnuevo').click(function () {
                $('#frmOrdenIngreso').each(function () {
                    this.reset();
                    $('#_idCliente').chosen({width: "85%"});
                    $('#_idTecnico').chosen({width: "100%"});
//                    $('#_idCliente').parent('div').append('<button type="button" class="btn btn-success" id="btnnuevoModal"><i class="glyphicon glyphicon-plus-sign"></i></button>');
                  });
                $('#_id').val(0);
                $('#_opc').val('I');
                modal.style.display = "block";
                $('#_numeroOrden').prop('disabled', true);
            });
            $("#btnSalir").click(function () {
                modal.style.display = "none";
                 location.reload();
            });
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });

        $(function () {
            //nuevo
            $('#frmUsuario').on({
                submit: function () {
//                    if (validaCedula($(_cedula).val()) == true) {
                        var form = $('#frmUsuario');
                        var disabled = form.find(':input:disabled').removeAttr('disabled');
                        var serialized = form.serialize();
                        disabled.attr('disabled', 'disabled');
                        $.ajax({
                            url: "usuarioopc.php",
                            data: serialized,
                            type: 'POST',
                            dataType: 'json',
                            success: function (data, textStatus, jqXHR) {
                                if (data.ok == true) {
                                    $('#_idCliente').append($('<option>', {value: data.cod, text: data.nombres}));
                                    $('#_idCliente').trigger("chosen:updated");
                                    alert("Guardado");
                                        location.reload();
                                    return;
                                }
                                alert(data.error + ' aqui esta el error');
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert(errorThrown);
                            }


                        });
//                    }
//                    else {
//                        alert("La cedula es incorrecta, verifique");
//                    }
                    return false;
                }
            });
            //finnuevo
            $('#frmOrdenIngreso').on({
                submit: function () {
                    $.ajax({
                        url: "ordeningresoopc.php",
                        data: $(this).serialize(),
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
                    url: "ordeningresoopc.php",
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
              $('#btnnuevoModal').hide(); //oculto mediante id
        var data = $(this).data('id');
                $('#_idOrdenIngreso').val(data.id);
                $('#_numeroOrden').prop('disabled', true);
                $.ajax({
                    url: "ordeningresoopc.php",
                    data: data,
                    type: 'POST',
                    dataType: 'json',
                    success: function (json, textStatus, jqXHR) {
                        $('#_opc').val('M');
                        $('#_idOrdenIngreso').val(json.idOrdenIngreso);
                        $('#_numeroOrden').val(json.numeroOrden);
                        $('#_fechaIngreso').val(json.fechaIngreso);
                        onload = document.forms['frmOrdenIngreso']['_idCliente'].value = json.idCliente
                        $('#_caracteristicasEquipo').val(json.caracteristicasEquipo);
                        $('#_antecedentes').val(json.antecedenteIngreso);
                        $('#_observacion').val(json.observacion);
                        $('#_fechaEntrega').val(json.fechaEntrega);
//                        setSeleccionarItem('_idTecnico', 8);
                        onload = document.forms['frmOrdenIngreso']['_idTecnico'].value = json.idTecnico
                        onload = document.forms['frmOrdenIngreso']['_estado'].value = json.estado
                        modal.style.display = "block";
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
