<?php

require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/TipoServicio.php';
require_once '../clases/interfaces/Itiposervicio.php';
require_once '../clases/dao/daoTipoServicio.php';

class ctrTipoServicio {

    private static $array;

    public function __construct($array = array()) {
        self::$array = $array;
    }

    public function opciones() {
        
    }

    public static function validate() {
        $datosForm = (object) self::$array;
        return $datosForm;
    }

    public static function getTiposServicios() {
        $Dao = new daoTipoServicio();
        return $Dao->listar();
    }

    public static function IdTipoServicio() {
        $dao = new daoTipoServicio();
        return $dao->Codigo();
    }

    public static function grabar() {
        $datosForm = self::validate();
        $modelo = new TipoServicio($datosForm->idTipoServicio, $datosForm->descripcion, $datosForm->estado);
        $dao = new daoTipoServicio();
        switch ($datosForm->opc) {
            case 'I': if ($dao->crear($modelo))
                    return '{"ok":true}';
            default : if ($dao->editar($modelo))
                    return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error al Grabar El Registro"}';
    }

    public static function editar() {
        $datosForm = (object) self::$array;
        $dao = new daoTipoServicio();
        $aJson = $dao->listarId($datosForm->id);
        return json_encode($aJson);
    }

    public static function eliminar() {
        $datosForm = self::validate();
        $dao = new daoTipoServicio();
        $modelo = new TipoServicio($datosForm->id, "", 0);
        if ($dao->delete($modelo)) {
            return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';
    }

}
