<?php
class OrdenIngreso {
    private $idOrdenIngreso;
    private $numeroOrden;
    private $fechaIngreso;
    private $idCliente;
    private $caracteristicasEquipo;
    private $antecedenteIngreso;
    private $observacion;
    private $fechaEntrega;
    private $idTecnico;
    private $estado;
    private $nombleCliente;
    private $apellidoCliente;
    private $direccionCliente;
    private $telefonoCliente;
    private $nombreTecnico;
    private $apellidoTecnico;
    private $cumplimiento;
    private $observacionTecnico;
    private $subtotal;
    private $iva;
    private $descuento;
    private $totalPagar;
    private $estadoPago;
    private $estadoOrden;
    function __construct($idOrdenIngreso=0, $numeroOrden="", $fechaIngreso="", $idCliente=0, $caracteristicasEquipo="", $antecedenteIngreso="", $observacion="", $fechaEntrega="", $idTecnico=0, $estado=0, $nombleCliente="", $apellidoCliente="", $direccionCliente="", $telefonoCliente="", $nombreTecnico="", $apellidoTecnico="", $cumplimiento="",$observacionTecnico="",$subtotal=0.0,$iva=0.0,$descuento=0.0,$totalPagar=0.0,$estadoPago=0,$estadoOrden=1) {
        $this->idOrdenIngreso = $idOrdenIngreso;
        $this->numeroOrden = $numeroOrden;
        $this->fechaIngreso = $fechaIngreso;
        $this->idCliente = $idCliente;
        $this->caracteristicasEquipo = $caracteristicasEquipo;
        $this->antecedenteIngreso = $antecedenteIngreso;
        $this->observacion = $observacion;
        $this->fechaEntrega = $fechaEntrega;
        $this->idTecnico = $idTecnico;
        $this->estado = $estado;
        $this->nombleCliente = $nombleCliente;
        $this->apellidoCliente = $apellidoCliente;
        $this->direccionCliente = $direccionCliente;
        $this->telefonoCliente = $telefonoCliente;
        $this->nombreTecnico = $nombreTecnico;
        $this->apellidoTecnico = $apellidoTecnico;
        $this->cumplimiento=$cumplimiento;
        $this->observacionTecnico= $observacionTecnico;
        $this->subtotal=$subtotal;
        $this->iva=$iva;
        $this->descuento=$descuento;
        $this->totalPagar=$totalPagar;
        $this->estadoPago=$estadoPago;
        $this->estadoOrden=$estadoOrden;
    }
    function getIdOrdenIngreso() {
        return $this->idOrdenIngreso;
    }

    function getNumeroOrden() {
        return $this->numeroOrden;
    }

    function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getCaracteristicasEquipo() {
        return $this->caracteristicasEquipo;
    }

    function getAntecedenteIngreso() {
        return $this->antecedenteIngreso;
    }

    function getObservacion() {
        return $this->observacion;
    }

    function getFechaEntrega() {
        return $this->fechaEntrega;
    }

    function getIdTecnico() {
        return $this->idTecnico;
    }

    function getEstado() {
        return $this->estado;
    }

    function getNombleCliente() {
        return $this->nombleCliente;
    }

    function getApellidoCliente() {
        return $this->apellidoCliente;
    }

    function getDireccionCliente() {
        return $this->direccionCliente;
    }

    function getTelefonoCliente() {
        return $this->telefonoCliente;
    }

    function getNombreTecnico() {
        return $this->nombreTecnico;
    }

    function getApellidoTecnico() {
        return $this->apellidoTecnico;
    }

    function getCumplimiento() {
        return $this->cumplimiento;
    }

    function getObservacionTecnico() {
        return $this->observacionTecnico;
    }

    function getSubtotal() {
        return $this->subtotal;
    }

    function getIva() {
        return $this->iva;
    }

    function getDescuento() {
        return $this->descuento;
    }

    function getTotalPagar() {
        return $this->totalPagar;
    }

    function getEstadoPago() {
        return $this->estadoPago;
    }

    function getEstadoOrden() {
        return $this->estadoOrden;
    }

    function setIdOrdenIngreso($idOrdenIngreso) {
        $this->idOrdenIngreso = $idOrdenIngreso;
    }

    function setNumeroOrden($numeroOrden) {
        $this->numeroOrden = $numeroOrden;
    }

    function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso = $fechaIngreso;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setCaracteristicasEquipo($caracteristicasEquipo) {
        $this->caracteristicasEquipo = $caracteristicasEquipo;
    }

    function setAntecedenteIngreso($antecedenteIngreso) {
        $this->antecedenteIngreso = $antecedenteIngreso;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    function setFechaEntrega($fechaEntrega) {
        $this->fechaEntrega = $fechaEntrega;
    }

    function setIdTecnico($idTecnico) {
        $this->idTecnico = $idTecnico;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setNombleCliente($nombleCliente) {
        $this->nombleCliente = $nombleCliente;
    }

    function setApellidoCliente($apellidoCliente) {
        $this->apellidoCliente = $apellidoCliente;
    }

    function setDireccionCliente($direccionCliente) {
        $this->direccionCliente = $direccionCliente;
    }

    function setTelefonoCliente($telefonoCliente) {
        $this->telefonoCliente = $telefonoCliente;
    }

    function setNombreTecnico($nombreTecnico) {
        $this->nombreTecnico = $nombreTecnico;
    }

    function setApellidoTecnico($apellidoTecnico) {
        $this->apellidoTecnico = $apellidoTecnico;
    }

    function setCumplimiento($cumplimiento) {
        $this->cumplimiento = $cumplimiento;
    }

    function setObservacionTecnico($observacionTecnico) {
        $this->observacionTecnico = $observacionTecnico;
    }

    function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    function setIva($iva) {
        $this->iva = $iva;
    }

    function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    function setTotalPagar($totalPagar) {
        $this->totalPagar = $totalPagar;
    }

    function setEstadoPago($estadoPago) {
        $this->estadoPago = $estadoPago;
    }

    function setEstadoOrden($estadoOrden) {
        $this->estadoOrden = $estadoOrden;
    }
}
