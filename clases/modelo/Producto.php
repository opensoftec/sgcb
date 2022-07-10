<?php

class Producto {
    private $idProducto;
    private $serie;
    private $descripcion;
    private $precio;
    private $cantidad;
    private $idTipoServicio;
    private $idMarca;
    private $idProveedor;
    private $observacion;
    private $estado;
    
    function __construct($idProducto=0, $serie="", $descripcion="", $precio=0.0, $cantidad=0, $idTipoServicio=0, $idMarca=0, $idProveedor=0, $observacion="",$estado=1) {
        $this->idProducto = $idProducto;
        $this->serie= $serie;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->idTipoServicio = $idTipoServicio;
        $this->idMarca = $idMarca;
        $this->idProveedor = $idProveedor;
        $this->observacion = $observacion;
        $this->estado = $estado;
    }
    
    function getSerie() {
        return $this->serie;
    }

    function setSerie($serie) {
        $this->serie = $serie;
    }

    
        function getIdProducto() {
        return $this->idProducto;
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

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
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

    function setIdProveedor($idProveedor) {
        $this->idProveedor = $idProveedor;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    
    function getObservacion() {
        return $this->observacion;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }



}
