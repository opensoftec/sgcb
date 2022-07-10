<?php

interface Iproveedor {
    public function crear(Proveedor $proveedor);
    public function editar (Proveedor $proveedor);
    public function delete (Proveedor $proveedor);
    public function listar();
    public function listarId($id);
}
