<?php

require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/Usuario.php';
require_once '../clases/interfaces/Iusuario.php';
require_once '../clases/dao/daoUsuario.php';

class ctrUsuario {

    private static $array;

    public function __construct($array = array()) {
        self::$array = $array;
    }

    public static function validate() {
        $datosForm = (object) self::$array;
        return $datosForm;
    }

    public static function getUsuarios() {
        $Dao = new daoUsuario();
        return $Dao->listar();
    }

    public static function getTecnicos() {
        $usuarioDao = new daoUsuario();
        return $usuarioDao->listarTecnico();
    }

    public static function getTecnicosAdministradores() {
        $usuarioDao = new daoUsuario();
        return $usuarioDao->listarTecnicoAdministrador();
    }

    public static function getUsuariosC() {
        $Dao = new daoUsuario();
        return $Dao->listarCliente();
    }

    public static function IdUsuario() {
        $dao = new daoUsuario();
        return $dao->Codigo();
    }

    public static function grabar() {
        $datosForm = self::validate();
        $modelo = new Usuario($datosForm->idUsuario, $datosForm->cedula, $datosForm->nombre, $datosForm->apellido, $datosForm->direccion, $datosForm->telefono, $datosForm->correo, $datosForm->usuario, $datosForm->contrasena, $datosForm->idTipoUsuario, $datosForm->estado);
        $dao = new daoUsuario();
        switch ($datosForm->opc) {
            //nuevo
            case 'I': if ($dao->crear($modelo)){
                $id = $dao->idCliente($datosForm->cedula);
                return '{"ok":true,"cod":"'.$id.'","nombres": "'.$datosForm->nombre.' '.$datosForm->apellido.'"}';}
            //finnuevo
            default : if ($dao->editar($modelo))
                    return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error al Grabar El Registro"}';
    }

    public static function editar() {
        //$datosForm = (object)self::$array;
        $datosForm = self::validate();
        $dao = new daoUsuario();
        $aJson = $dao->listarId($datosForm->id);
        return json_encode($aJson);
    }

    public static function eliminar() {
        $datosForm = self::validate();
        $dao = new daoUsuario();
        $modelo = new Usuario($datosForm->id, "", "", "", "", "", "", "", "", "", 0);
        if ($dao->delete($modelo)) {
            return '{"ok":true}';
        }
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';
    }

    public static function login() {
        $datosForm = self::validate();
        $dao = new daoUsuario();
        $modelo = new Usuario();
        $modelo->setUsuario($datosForm->usuario);
        $modelo->setClave($datosForm->contrasena);
        return $dao->login($modelo);
    }

}
