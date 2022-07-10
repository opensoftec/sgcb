<?php

class TipoServicio {
    private $idTservicio;
    private $descripcion;
    private $estado;
    
    function __construct($idTservicio=0, $descripcion="", $estado=1) {
        $this->idTservicio = $idTservicio;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }
    
    function getIdTservicio() {
        return $this->idTservicio;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdTservicio($idTservicio) {
        $this->idTservicio = $idTservicio;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }


}
