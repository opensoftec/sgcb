<?php
require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/Marca.php';
require_once '../clases/interfaces/Imarca.php';
require_once '../clases/dao/daoMarca.php';

class ctrMarca {

    private static $array;

    public function __construct($array = array()) {
        self::$array = $array;
    }

    public static function validate() {
        $datosForm = (object) self::$array;
        return $datosForm;
    }

    public static function getMarcas() {
        $Dao = new daoMarca();
        return $Dao->listar();
    }

    public static function grabar() {
        $datosForm = self::validate();
        $modelo = new Marca($datosForm->idMarca, $datosForm->descripcion, $datosForm->estado);
        $dao = new daoMarca();
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
        $dao = new daoMarca();
        $aJson = $dao->listarId($datosForm->id);
        return json_encode($aJson);
    }

    public static function eliminar() {
        $datosForm = self::validate();
        $dao = new daoMarca();
        $modelo = new Marca($datosForm->id, "", 0);
        if ($dao->delete($modelo)) {
            return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';
    }

}
