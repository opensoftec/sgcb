<?php

class DepartamentoProveedor {
    private $idDepartamentoProveedor;
    private $descripcion;
    private $responsable;
    private $telefono;
    private $idProveedor;
    private $sucursal;
    private $estado;
    
    function __construct($idDepartamentoProveedor=0, $descripcion="", $responsable="", $telefono="", $idProveedor=0, $estado=1,$sucursal="") {
        $this->idDepartamentoProveedor = $idDepartamentoProveedor;
        $this->descripcion = $descripcion;
        $this->responsable = $responsable;
        $this->telefono = $telefono;
        $this->idProveedor = $idProveedor;
        $this->estado = $estado;
        $this->sucursal=$sucursal;
    }
    
    
    function getSucursal() {
        return $this->sucursal;
    }

    function setSucursal($sucursal) {
        $this->sucursal = $sucursal;
    }

        function getIdDepartamentoProveedor() {
        return $this->idDepartamentoProveedor;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getIdProveedor() {
        return $this->idProveedor;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdDepartamentoProveedor($idDepartamentoProveedor) {
        $this->idDepartamentoProveedor = $idDepartamentoProveedor;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setIdProveedor($idProveedor) {
        $this->idProveedor = $idProveedor;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

}
