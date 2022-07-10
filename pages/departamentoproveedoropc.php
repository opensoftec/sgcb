<?php
require '../clases/controlador/ctrDepartamentoProveedor.php';
$action = $_POST["action"];
$departamentoProveedor = new ctrDepartamentoProveedor($_POST);

switch ($action) {
    case "add":
        echo $departamentoProveedor->grabar();

        break;
    
    case "elim":
        echo $departamentoProveedor->eliminar();

        break;
    
    case "edit":
        echo $departamentoProveedor->editar();

        break;

    default:
        break;
}
