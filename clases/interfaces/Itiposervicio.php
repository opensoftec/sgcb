<?php

interface Itiposervicio {
    public function crear(TipoServicio $tiposervicio);
    public function editar (TipoServicio $tiposervicio);
    public function delete (TipoServicio $tiposervicio);
    public function listar();
    public function listarId($id);
}
