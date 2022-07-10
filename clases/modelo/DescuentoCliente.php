<?php
class DescuentoCliente {
    private $idDescuentoCliente;
    private $idCliente;
    private $descuento;
    private $estado;
    
    function __construct($idDescuentoCliente=0, $idCliente=0, $descuento=0.0, $estado=1) {
        $this->idDescuentoCliente = $idDescuentoCliente;
        $this->idCliente = $idCliente;
        $this->descuento = $descuento;
        $this->estado = $estado;
    }

    function getIdDescuentoCliente() {
        return $this->idDescuentoCliente;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getDescuento() {
        return $this->descuento;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdDescuentoCliente($idDescuentoCliente) {
        $this->idDescuentoCliente = $idDescuentoCliente;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }


    

}
