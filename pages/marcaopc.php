<?php
require '../clases/controlador/ctrMarca.php';
$action = $_POST["action"];
$marca = new ctrMarca($_POST);

switch ($action) {
    case "add":
        echo $marca->grabar();

        break;
    
    case "elim":
        echo $marca->eliminar();

        break;
    
    case "edit":
        echo $marca->editar();

        break;

    default:
        break;
}