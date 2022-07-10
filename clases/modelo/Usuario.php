<?php

class Usuario {

    private $idUsuario;
    private $cedula;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    private $correo;
    private $usuario;
    private $clave;
    private $idTipoUsuario;
    private $estado;

    function __construct($idUsuario = 0, $cedula = "", $nombre = "", $apellido = "", $direccion = "", $telefono = "", $correo = "", $usuario = "", $clave = "", $idTipoUsuario = 0, $estado = 1) {
        $this->idUsuario = $idUsuario;
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->idTipoUsuario = $idTipoUsuario;
        $this->estado = $estado;
    }
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getClave() {
        return $this->clave;
    }

    function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setIdTipoUsuario($idTipoUsuario) {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
}
