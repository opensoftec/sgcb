<?php
require '../clases/controlador/ctrProducto.php';
$action = $_POST["action"];
$productos = new ctrProducto($_POST);

switch ($action) {
    case "add":
        echo $productos->grabar();

        break;
    
    case "elim":
        echo $productos->eliminar();

        break;
    
    case "edit":
        echo $productos->editar();

        break;

    default:
        break;
}
