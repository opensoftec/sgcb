<?php

interface Iusuario {
    public function crear(Usuario $usuario);
    public function editar (Usuario $usuario);
    public function delete (Usuario $usuario);
    public function listar();
    public function listarCliente();
    public function listarId($id);
    public function login(Usuario $usuario);
}
