<?php

interface Iproducto {
    public function crear (Producto $producto);
    public function editar (Producto $producto);
    public function delete (Producto $producto);
    public function listar();
    public function listarId($id);
}
