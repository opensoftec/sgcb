<?php
require '../clases/controlador/ctrTipoUsuario.php';
$action = $_POST["action"];
$tipousuario = new ctrTipoUsuario($_POST);

switch ($action) {
    case "add":
        echo $tipousuario->grabar();

        break;
    
    case "elim":
        echo $tipousuario->eliminar();

        break;
    
    case "edit":
        echo $tipousuario->editar();

        break;

    default:
        break;
}