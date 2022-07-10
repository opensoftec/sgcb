<?php

require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/Proveedor.php';
require_once '../clases/interfaces/Iproveedor.php';
require_once '../clases/dao/daoProveedor.php';

class ctrProveedor {

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

    public static function getProveedores() {
        $Dao = new daoProveedor();
        return $Dao->listar();
    }

    public static function IdProveedor() {
        $dao = new daoProveedor();
        return $dao->Codigo();
    }

    public static function grabar() {
        $datosForm = self::validate();
        $modelo = new Proveedor($datosForm->idProveedor, $datosForm->nombre, $datosForm->sucursal, $datosForm->direccion, $datosForm->telefono, $datosForm->responsable, $datosForm->estado);
        $dao = new daoProveedor();
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
        $dao = new daoProveedor();
        $aJson = $dao->listarId($datosForm->id);
        return json_encode($aJson);
    }

    public static function eliminar() {
        $datosForm = self::validate();
        $dao = new daoProveedor();
        $modelo = new Proveedor($datosForm->id, "", "", "", "", "", 0);
        if ($dao->delete($modelo)) {
            return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';
    }

}
