<?php
require_once '../clases/modelo/Usuario.php';
session_start();

if (isset($_SESSION['usuario'])) {
    $Sesion = unserialize($_SESSION['usuario']);
} else {
    header('Location: login.php');
}

?>
