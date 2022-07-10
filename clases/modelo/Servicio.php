<?php
class Servicio {
    private $idServicio;
    private $descripcion;
    private $precio;
    private $idTipoServicio;
    private $observacion;
    private $estado;
    
    function __construct($idServicio=0, $descripcion="", $precio=0.0, $idTipoServicio=0,$observacion="", $estado=1) {
        $this->idServicio = $idServicio;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->idTipoServicio = $idTipoServicio;
        $this->observacion=$observacion;
        $this->estado = $estado;
    }
    
    function getObservacion() {
        return $this->observacion;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

        function getIdServicio() {
        return $this->idServicio;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getIdTipoServicio() {
        return $this->idTipoServicio;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdServicio($idServicio) {
        $this->idServicio = $idServicio;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setIdTipoServicio($idTipoServicio) {
        $this->idTipoServicio = $idTipoServicio;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

}
