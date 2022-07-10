<?php
require '../clases/controlador/ctrProveedor.php';
$action = $_POST["action"];
$proveedor = new ctrProveedor($_POST);

switch ($action) {
    case "add":
        echo $proveedor->grabar();

        break;
    
    case "elim":
        echo $proveedor->eliminar();

        break;
    
    case "edit":
        echo $proveedor->editar();

        break;

    default:
        break;
}