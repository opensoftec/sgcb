<?php

class Marca {

    private $idMarca;
    private $descripcion;
    private $estado;

    function __construct($idMarca = 0, $descripcion = "", $estado = 1) {
        $this->idMarca = $idMarca;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }

    function getIdMarca() {
        return $this->idMarca;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdMarca($idMarca) {
        $this->idMarca = $idMarca;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

}
