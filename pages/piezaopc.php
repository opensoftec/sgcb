<?php
require '../clases/controlador/ctrPieza.php';
$action = $_POST["action"];
$piezas = new ctrPieza($_POST);

switch ($action) {
    case "add":
        echo $piezas->grabar();

        break;
    
    case "elim":
        echo $piezas->eliminar();

        break;
    
    case "edit":
        echo $piezas->editar();

        break;

    default:
        break;
}

