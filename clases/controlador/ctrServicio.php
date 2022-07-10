<?php

require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/Servicio.php';
require_once '../clases/interfaces/Iservicio.php';
require_once '../clases/dao/daoServicio.php';

class ctrServicio {

    private static $array;

    public function __construct($array = array()) {
        self::$array = $array;
    }

    public static function validate() {
        $datosForm = (object) self::$array;
        return $datosForm;
    }

    public static function getServicios() {
        $Dao = new daoServicio();
        return $Dao->listar();
    }

    public static function grabar() {
        $datosForm = self::validate();
        $modelo = new Servicio($datosForm->idServicio, $datosForm->descripcion, $datosForm->precio, $datosForm->idTipoProducto, $datosForm->observacion, $datosForm->estado);
        $dao = new daoServicio();
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
        $dao = new daoServicio();
        $aJson = $dao->listarId($datosForm->id);
        return json_encode($aJson);
    }

    public static function eliminar() {
        $datosForm = self::validate();
        $dao = new daoServicio();
        $modelo = new Servicio($datosForm->id, "", 0.0, 0, "", 0);
        if ($dao->delete($modelo)) {
            return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';
    }

}
