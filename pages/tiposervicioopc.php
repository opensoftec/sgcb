<?php
require '../clases/controlador/ctrTipoServicio.php';
$action = $_POST["action"];
$tiposervicio = new ctrTipoServicio($_POST);

switch ($action) {
    case "add":
        echo $tiposervicio->grabar();

        break;
    
    case "elim":
        echo $tiposervicio->eliminar();

        break;
    
    case "edit":
        echo $tiposervicio->editar();

        break;

    default:
        break;
}