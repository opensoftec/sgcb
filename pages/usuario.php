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
    <head>
        <meta charset="UTF-8">
        <title>Usuario</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/icono_1.png" type="image/png"/>
        <?php require '../clases/controlador/ctrTipoUsuario.php'; ?>
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
                                        <img src="../img/menu/usuario.png" height="65">
                                    </div>
                                    <div class="col col-xs-3">
                                        <h3>Listado De Usuarios</h3>
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
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>apellido</th>
                                            <th>Direccion</th>
                                            <th>Telefono</th>
                                            <th>Correo</th>
                                            <th>Usuario</th>
                                            <th>Tipo Usuario</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr> 
                                    </thead>
                                    <tbody id="tdetalle">
                                        <?php
                                        if ($Sesion->getIdTipoUsuario() == 2) {
                                            $usuarios = ctrUsuario::getUsuariosC();
                                        } else {
                                            $usuarios = ctrUsuario::getUsuarios();
                                        }

                                        foreach ($usuarios as $usuario) {
                                            if ($usuario->getEstado() == true or ( $usuario->getEstado() == false and $Sesion->getIdTipoUsuario() == 1)) {
                                                $id = $usuario->getIdUsuario();
                                                ?>
                                                <tr>
                                                    <td align="center"><?= $usuario->getIdUsuario() ?></td>
                                                    <td align="center"><?= $usuario->getCedula() ?></td>
                                                    <td align="center"><?= $usuario->getNombre() ?></td>
                                                    <td align="center"><?= $usuario->getApellido() ?></td>
                                                    <td align="center"><?= $usuario->getDireccion() ?></td>
                                                    <td align="center"><?= $usuario->getTelefono() ?></td>
                                                    <td align="center"><?= $usuario->getCorreo() ?></td>
                                                    <td align="center"><?= $usuario->getUsuario() ?></td>
                                                    <td align="center"><?= $usuario->getIdTipoUsuario() ?></td>
                                                    <?php if ($usuario->getEstado() != true) { ?>
                                                        <td align="center"><span class="label label-danger" title="Inactivo">Inactivo</span></td>
                                                    <?php } else { ?>
                                                        <td align="center"><span class="label label-success" title="Activo">Activo</span></td>
                                                    <?php } ?>
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
                    <div id="dialog" title="Mantenimiento de usuarios" >
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
                                            <input type="text"  class="form-control" id="_cedula" name="cedula" placeholder="Ingrese solo numeros"  required="true" pattern="[0-9]{10}" onkeypress="return controltag(event)" >
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
                                        <label class="control-label col-xs-2">Usuario:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" placeholder="Eje: jholguinm" id="_usuario" name="usuario"  required="true">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-2">Contraseña:</label>
                                        <div class="col-xs-4">
                                            <input type="password" class="form-control" id="_contrasena" name="contrasena" placeholder="Ingrese la clave" maxlength="" required="true">
                                        </div>
                                        <label class="control-label col-xs-2">Tipo:</label>
                                        <div class="col-xs-4">
                                            <select class="form-control" id="_idTipoUsuario" name="idTipoUsuario" <?php if ($Sesion->getIdTipoUsuario() == 2) { ?> disabled="" <?php } ?>>
                                                <?php
                                                $tipos = ctrTipoUsuario::getTipoUsuarios();
                                                foreach ($tipos as $tipo) {
                                                    if ($tipo->getEstado() == true) {
                                                        ?>
                                                        <option value="<?= $tipo->getIdTipoUsuario() ?>" <?php if ($Sesion->getIdTipoUsuario() == 2 and $tipo->getIdTipoUsuario() == 4) { ?> selected="" <?php } ?>><?= $tipo->getDescripcion() ?></option>
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
                                            <input type="text" class="form-control" id="_correo" name="correo"  required="true" placeholder="orlasic@gmail.com">
                                        </div>
                                    </div>

                                    <div class="form-group center-block">
                                        <button type="submit" class="btn btn-toolbar btn-lg active" name="Grabar" id="btngrabar" style="margin-left:260px;"><span class="glyphicon glyphicon-bell"></span> Grabar</button> 
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
          $('.input-number').on('input', function () { 
            this.value = this.value.replace(/[^0-9]/g,'');
        });
            function validaCedula(cedula){
//                if (e.keyCode === 13 && !e.shiftKey) {
                array = cedula.split( "" );
                num = array.length;
                    if ( num == 10 )
                        {
                            total = 0;
                            digito = (array[9]*1);
                            for( i=0; i < (num-1); i++ )
                            {
                                    mult = 0;
                                    if ( ( i%2 ) != 0 ) {
                                    total = total + ( array[i] * 1 );
                                    }
                                else
                                {
                                    mult = array[i] * 2;
                                        if ( mult > 9 )
                                        total = total + ( mult - 9 );
                                        else
                                            total = total + mult;
                                }
                            }
                    decena = total / 10;
                    decena = Math.floor( decena );
                    decena = ( decena + 1 ) * 10;
                    final = ( decena - total );
                        if ( ( final == 10 && digito == 0 ) || ( final == digito ) ) {
//                            alert( "La c\xe9dula ES v\xe1lida!!!" );
                            return true;
                        }
                        else
                        {
                            alert( "la cedula no es valida" );
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
            function controltag(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0||tecla==9)  return true;
       // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
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
                $("#btnSalir").click(function () {
                    $("#dialog").dialog("close");
                });
            });

            $(function () {
                $('#frmUsuario').on({
                    submit: function () {
//                        if(validaCedula($(_cedula).val())==true){
                        var form = $('#frmUsuario');
                        var disabled = form.find(':input:disabled').removeAttr('disabled');
                        var serialized = form.serialize();
                        disabled.attr('disabled','disabled');
                        $.ajax({
                            url: "usuarioopc.php",
                            data: serialized,
                            type: 'POST',
                            dataType: 'json',
                            
                            success: function (data, textStatus, jqXHR) {
                                if (data.ok == true) {
                                    alert("Guardado");
                                    location.reload();
                                    return ;
                                }
                                alert(data.error);
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert(errorThrown);
                            }
                            
                            
                        });
//                    }
//                    else{
//                        alert("La cedula es incorrecta, verifique");
//                    }    
                        return false;
                        
                        
                    }
                });
                $('#tdatos #tdetalle').on('click', 'a[rel="elim"]', function () {
                    var data = $(this).data('id');
                    $.ajax({
                        url: "usuarioopc.php",
                        data: data,
                        type: 'POST',
                        dataType: 'json',
                        success: function (data, textStatus, jqXHR) {
                            if (data.ok == true) {
                                alert("se elimino correctamente");
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
                    $('#_idUsuario').val(data.id);
                    $.ajax({
                        url: "usuarioopc.php",
                        data: data,
                        type: 'POST',
                        dataType: 'json',
                        success: function (json, textStatus, jqXHR) {
                            $('#_opc').val('M');
                            $('#_idUsuario').val(json.idUsuario);
                            $('#_cedula').val(json.cedula);
                            $('#_nombre').val(json.nombre);
                            $('#_apellido').val(json.apellido);
                            $('#_direccion').val(json.direccion);
                            $('#_telefono').val(json.telefono);
                            $('#_correo').val(json.correo);
                            $('#_usuario').val(json.usuario);
                            $('#_clave').val(json.contrasena);
                            setSeleccionarItem('_idTipoUsuario', json.idTipoUsuario);
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
    </body>
</html>
