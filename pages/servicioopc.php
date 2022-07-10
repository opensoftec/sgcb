<?php
require '../clases/controlador/ctrServicio.php';
$action = $_POST["action"];
$servicios = new ctrServicio($_POST);

switch ($action) {
    case "add":
        echo $servicios->grabar();

        break;
    
    case "elim":
        echo $servicios->eliminar();

        break;
    
    case "edit":
        echo $servicios->editar();

        break;

    default:
        break;
}
