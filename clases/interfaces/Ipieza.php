<?php
interface Ipieza {
    public function crear(Pieza $pieza); 
    public function editar (Pieza $pieza);
    public function delete (Pieza $pieza);
    public function listar ();
    public function listarId ($id);
}
