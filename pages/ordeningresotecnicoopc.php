<?php
require '../clases/controlador/ctrOrdenIngreso.php';
$action = $_POST["action"];
$ordenIngreso = new ctrOrdenIngreso($_POST);

switch ($action) {
    case "add":
        echo $ordenIngreso->grabarCumplimiento();

        break;
    
    case "elim":
        echo $marca->eliminar();

        break;
    
    case "edit":
        echo $ordenIngreso->grabarCumplimiento();

        break;

    default:
        break;
}