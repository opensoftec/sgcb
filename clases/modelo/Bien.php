<?php

class Bien {
    private $numero;
    private $codigo;
    private $descripcion;
    private $serie;
    private $modelo;
    private $marca;
    private $ubicacion;
    private $bien;
    function __construct($numero=0, $codigo="", $descripcion="", $serie="", $modelo="", $marca="", $ubicacion="", $bien="") {
        $this->numero = $numero;
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->serie = $serie;
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->ubicacion = $ubicacion;
        $this->bien = $bien;
    }
    function getNumero() {
        return $this->numero;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getSerie() {
        return $this->serie;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getMarca() {
        return $this->marca;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }

    function getBien() {
        return $this->bien;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setSerie($serie) {
        $this->serie = $serie;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function setBien($bien) {
        $this->bien = $bien;
    }

}
