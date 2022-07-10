<?php

class TipoUsuario {
    private $idTipoUsuario;
    private $descripcion;
    private $estado;
    
    function __construct($idTipoUsuario=0, $descripcion="", $estado=1) {
        $this->idTipoUsuario = $idTipoUsuario;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }
    
    function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdTipoUsuario($idTipoUsuario) {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }



}
