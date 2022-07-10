<?php

class Proveedor {
    private $idProveedor;
    private $nombre;
    private $sucursal;
    private $direccion;
    private $telefono;
    private $responsable;
    private $estado;
    
    function __construct($idProveedor=0, $nombre="", $sucursal="", $direccion="", $telefono="", $responsable="", $estado=1){
        $this->idProveedor = $idProveedor;
        $this->nombre = $nombre;
        $this->sucursal = $sucursal;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->responsable = $responsable;
        $this->estado = $estado;
    }
    
    function getIdProveedor() {
        return $this->idProveedor;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getSucursal() {
        return $this->sucursal;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdProveedor($idProveedor) {
        $this->idProveedor = $idProveedor;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setSucursal($sucursal) {
        $this->sucursal = $sucursal;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
}
