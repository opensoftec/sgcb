<?php

require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/OrdenIngreso.php';
require_once '../clases/interfaces/Iordeningreso.php';
require_once '../clases/dao/daoOrdenIngreso.php';

class ctrOrdenIngreso {

    private static $array;

    public function __construct($array = array()) {
        self::$array = $array;
    }

    public static function validate() {
        $datosForm = (object) self::$array;
        return $datosForm;
    }

    public static function getListadoOrdenCliente($id) {
        $Dao = new daoOrdenIngreso();
        return $Dao->listarOrdenCliente($id);
    }

    public static function getOrdenesIngreso() {
        $Dao = new daoOrdenIngreso();
        return $Dao->listar();
    }

    public static function getNumeroOrden() {
        $Dao = new daoOrdenIngreso();
        return $Dao->numeroOrden();
    }

    public static function getOrdenesIngresoTecnico($id) {
        $Dao = new daoOrdenIngreso();
        return $Dao->listarOrdenTecnico($id);
    }

    public static function getOrdenesIngresoAdministrador() {
        $Dao = new daoOrdenIngreso();
        return $Dao->listarOrdenAdministrador();
    }

    public static function grabar() {
        $daoOrdenIngreso = new daoOrdenIngreso();
        $datosForm = self::validate();
        $modelo = new OrdenIngreso($datosForm->idOrdenIngreso, $daoOrdenIngreso->numeroOrden(), $datosForm->fechaIngreso, $datosForm->idCliente, $datosForm->caracteristicasEquipo, $datosForm->antecedentes, $datosForm->observacion, $datosForm->fechaEntrega, $datosForm->idTecnico, $datosForm->estado, "", "", "", "", "", "", "", "", 0.0, 0.0, 0.0, 0.0);
        $dao = new daoOrdenIngreso();
        switch ($datosForm->opc) {
            case 'I': if ($dao->crear($modelo))
                    return '{"ok":true}';
            default : if ($dao->editar($modelo))
                    return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error al Grabar El Registro"}';
    }

    public static function grabarCumplimiento() {
        $datosForm = self::validate();
        $modelo = new OrdenIngreso($datosForm->idOrdenIngreso, 0, "", 0, "", "", "", "", "", $datosForm->estado, "", "", "", "", "", "", $datosForm->cumplimiento, $datosForm->observacionTecnico);
        $dao = new daoOrdenIngreso();
        //switch ($datosForm->opc){      

        if ($dao->editarCumplimientoTecnico($modelo))
            return '{"ok":true}';
        //}       
        return '{"error":"Ha ocurrido un Error al Grabar El Registro"}';
    }

    public static function grabarPagoAdministrador() {
        $datosForm = self::validate();
        $modelo = new OrdenIngreso($datosForm->idOrdenIngreso, "", "", 0, "", "", "", "", 0, $datosForm->estadoOrden, "", "", "", "", "", "", "", "", $datosForm->subtotal, 0.0, $datosForm->descuento, $datosForm->totalPagar, $datosForm->estadoPago);
        $dao = new daoOrdenIngreso();
        //switch ($datosForm->opc){      

        if ($dao->editarPagoAdministrador($modelo))
            return '{"ok":true}';
        //}       
        return '{"error":"Ha ocurrido un Error al Grabar El Registro"}';
    }

    public static function editar() {
        $datosForm = (object) self::$array;
        $dao = new daoOrdenIngreso();
        $aJson = $dao->listarId($datosForm->id);
        return json_encode($aJson);
    }

    public static function eliminar() {
        $datosForm = self::validate();
        $dao = new daoOrdenIngreso();
        $modelo = new OrdenIngreso($datosForm->id, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", 0);
        if ($dao->delete($modelo)) {
            return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';
    }
    
    public static function buscarOrdenCliente($numeroOrden, $clave) {
        $dao = new daoOrdenIngreso();
       
        return $dao->listarOrdenCliente($numeroOrden, $clave);
    }

}
