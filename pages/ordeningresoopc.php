<?php
require '../clases/controlador/ctrOrdenIngreso.php';
$action = $_POST["action"];
$ordenIngreso = new ctrOrdenIngreso($_POST);

switch ($action) {
    case "add":
        echo $ordenIngreso->grabar();

        break;
    
    case "elim":
        echo $ordenIngreso->eliminar();

        break;
    
    case "edit":
        echo $ordenIngreso->editar();

        break;

    default:
        break;
}
