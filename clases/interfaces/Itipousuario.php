<?php

interface Itipousuario {
    public function crear(TipoUsuario $tipousuario);
    public function editar (TipoUsuario $tipousuario);
    public function delete (TipoUsuario $tipousuario);
    public function listar();
    public function listarId($id);
}
