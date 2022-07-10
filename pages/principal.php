<?php
include 'session.php';
if ($Sesion->getIdTipoUsuario() == 4) {
    header('Location: cliente.php');
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
        
        <title>Principal</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/icono_1.png" type="image/png"/>
    </head>
    <body>
        <?php include "principaltop.php" ?>

        <article id="content">
            <div class="container">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row-fluid" id="menu">
                                <?php if ($Sesion->getIdTipoUsuario() == 1 || $Sesion->getIdTipoUsuario() == 5) { ?>
                                    <a href="usuario.php" class="icon well sbox">
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="../img/menu/usuario.png" border="0">
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Usuario</h4>
                                                <span class="icondesc">Administración de Usuarios</span>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>

                                <?php if ($Sesion->getIdTipoUsuario() == 1 || $Sesion->getIdTipoUsuario() == 5) { ?>
                                    <a href="tipousuario.php" class="icon well sbox" >
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="../img/menu/tipo de usuarios.png" border="0">
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Tipo De Usuario</h4>
                                                <span class="icondesc">Administración de Tipos de Usuarios</span>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>

                                <?php if ($Sesion->getIdTipoUsuario() != 3) { ?>

                                    <a href="marca.php" class="icon well sbox" >
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="../img/menu/marcas.png" border="0">
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Marca</h4>
                                                <span class="icondesc">Administración de Marcas</span>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="proveedor.php" class="icon well sbox">
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="../img/menu/proveedor.png" border="0">
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Proveedor</h4>
                                                <span class="icondesc">Administración de Proveedores</span>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="tiposervicio.php" class="icon well sbox">
                                        <div class="iconimage" >
                                            <div class="pd">
                                                <img src="../img/menu/tipo de servicio.png" border="0">
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Tipo Bien</h4>
                                                <span class="icondesc">Administración de Tipos de Bienes</span>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="producto.php" class="icon well sbox" >
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="../img/menu/producto.png" border="0">
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Bien</h4>
                                                <span class="icondesc">Administración de Bienes</span>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="pieza.php" class="icon well sbox" >
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="../img/menu/piezas.png" border="0">
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Pieza</h4>
                                                <span class="icondesc">Administración de Piezas</span>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>

                                <a href="servicio.php" class="icon well sbox" >
                                    <div class="iconimage">
                                        <div class="pd">
                                            <img src="../img/menu/servicio .png" border="0">
                                        </div>
                                    </div>
                                    <div class="iconname">
                                        <div class="pd">
                                            <h4 class="tituloicon">Servicio</h4>
                                            <span class="icondesc">Administración de Servicios</span>
                                        </div>
                                    </div>
                                </a>

                                <?php if ($Sesion->getIdTipoUsuario() == 3 || $Sesion->getIdTipoUsuario() == 5) { ?>
                                    <a href="ordeningresotecnico.php" class="icon well sbox" >
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="../img/menu/caja.png" border="0">
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Orden de Ingreso Tecnico</h4>
                                                <span class="icondesc">Administración de Ordenes de Ingresos</span>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>

                                <?php if ($Sesion->getIdTipoUsuario() == 1 || $Sesion->getIdTipoUsuario() == 5 || $Sesion->getIdTipoUsuario() == 2) { ?>
                                    <a href="reportes.php" class="icon well sbox" >
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="../img/menu/reporte.png" border="0">
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Reportes</h4>
                                                <span class="icondesc">Administración de Reportes</span>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>

                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

        </article>

        <?php include "./principalfooter.php" ?>

        <script src="../lib/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
