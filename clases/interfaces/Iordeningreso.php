<?php

interface Iordeningreso  {
    public function crear(OrdenIngreso $ordenIngreso); 
    public function editar (OrdenIngreso $ordenIngreso);
    public function delete (OrdenIngreso $ordenIngreso);
    public function listar ();
    public function listarId ($id);
}
