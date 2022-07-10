<?php
require '../clases/controlador/ctrUsuario.php';
$action = $_POST["action"];
$usuario = new ctrUsuario($_POST);

switch ($action) {
    case "add":
        echo $usuario->grabar();
        break;
    
    case "elim":
        echo $usuario->eliminar();
        break;
    
    case "edit":
        echo $usuario->editar();
        break;

    default:
        break;
}