<?php

interface Idepartamentoproveedor {
    public function crear (DepartamentoProveedor $departamentoProveedor);
    public function editar (DepartamentoProveedor $departamentoProveedor);
    public function delete (DepartamentoProveedor $departamentoProveedor);
    public function listar ();
    public function listarId ($idDepartamentoProveedor);
}
