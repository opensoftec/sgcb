<?php
interface Idescuentocliente {
   public function crear (DescuentoCliente $descuentoCliente);
   public function editar (DescuentoCliente $descuentoCliente);
   public function delete (DescuentoCliente $descuentoCliente);
   public function listar ();
   public function listarId($id);
}
