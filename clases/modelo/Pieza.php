<?php

class Pieza {
    private $idPieza;
    private $serie;
    private $descripcion;
    private $precio;
    private $cantidad;
    private $idTipoServicio;
    private $idMarca;
    private $idProveedor;
    private $observacion;
    private $estado;
    
    function __construct($idPieza=0, $serie="", $descripcion="", $precio=0.0, $cantidad=0, $idTipoServicio=0, $idMarca=0, $idProveedor=0, $observacion="",$estado=1) {
        $this->idPieza = $idPieza;
        $this->serie = $serie;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->idTipoServicio = $idTipoServicio;
        $this->idMarca = $idMarca;
        $this->idProveedor = $idProveedor;
        $this->observacion= $observacion;
        $this->estado = $estado;
    }
    
    function getIdPieza() {
        return $this->idPieza;
    }

    function getCodigoSerie() {
        return $this->serie;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getIdTipoServicio() {
        return $this->idTipoServicio;
    }

    function getIdMarca() {
        return $this->idMarca;
    }

    function getIdProveedor() {
        return $this->idProveedor;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdPieza($idPieza) {
        $this->idPieza = $idPieza;
    }

    function setCodigoSerie($codigoSerie) {
        $this->serie = $codigoSerie;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setIdTipoServicio($idTipoServicio) {
        $this->idTipoServicio = $idTipoServicio;
    }

    function setIdMarca($idMarca) {
        $this->idMarca = $idMarca;
    }
    
    function getSerie() {
        return $this->serie;
    }

    function getObservacion() {
        return $this->observacion;
    }

    function setSerie($serie) {
        $this->serie = $serie;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    
    function setIdProveedor($idProveedor) {
        $this->idProveedor = $idProveedor;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

}
