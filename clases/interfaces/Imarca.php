<?php

interface Imarca {
    public function crear(Marca $marca);
    public function editar (Marca $marca);
    public function delete (Marca $marca);
    public function listar();
    public function listarId($id);
}
