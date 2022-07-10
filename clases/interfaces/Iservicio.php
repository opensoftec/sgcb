<?php
interface Iservicio {
    public function crear (Servicio $servicio);
    public function editar (Servicio $servicio);
    public function delete (Servicio $servicio);
    public function listar ();
    public function listarId ($idServicio);
}
