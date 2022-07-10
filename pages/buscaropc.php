<?php
require '../clases/controlador/ctrOrdenIngreso.php';
session_start();
$orden = new ctrOrdenIngreso($_POST);
$sOrden = $orden->buscarOrdenCliente();
$inicio = "0";

if (count($sUsuario)) {
    $dato = (object) $sOrden;
    $modelo = new OrdenIngreso($dato->idOrdenIngreso);
    $_SESSION['usuario'] = serialize($modelo);
    $inicio = $modelo->getIdTipoUsuario();
} 

switch ($inicio) {
    case "4":
        echo '{"ok":true,"url":"cliente.php"}';
        break;

    case "0":
        echo '{"ok":false}';
        break;

    default:
        echo '{"ok":true,"url":"principal.php"}';
        break;
}
?>