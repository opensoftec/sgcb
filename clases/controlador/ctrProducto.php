<?php

require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/Producto.php';
require_once '../clases/interfaces/Iproducto.php';
require_once '../clases/dao/daoProducto.php';

class ctrProducto {

    private static $array;

    public function __construct($array = array()) {
        self::$array = $array;
    }

    public static function validate() {
        $datosForm = (object) self::$array;
        return $datosForm;
    }

    public static function getProductos() {
        $Dao = new daoProducto();
        return $Dao->listar();
    }

    public static function grabar() {
        $datosForm = self::validate();
        $modelo = new Producto($datosForm->idProducto, $datosForm->serie, $datosForm->descripcion, $datosForm->precio, $datosForm->cantidad, $datosForm->idTipoProducto, $datosForm->idMarca, $datosForm->idProveedor, $datosForm->observacion);
        $dao = new daoProducto();
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
        $dao = new daoProducto();
        $aJson = $dao->listarId($datosForm->id);
        return json_encode($aJson);
    }

    public static function eliminar() {
        $datosForm = self::validate();
        $dao = new daoProducto();
        $modelo = new Producto($datosForm->id, "", "", 0.0, 0, 0, 0, 0, "", 0);
        if ($dao->delete($modelo)) {
            return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';
    }

}
