<?php
require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/TipoUsuario.php';
require_once '../clases/interfaces/Itipousuario.php';
require_once '../clases/dao/daoTipoUsuario.php';
class ctrTipoUsuario {
    
    private static $array;
    
    public function __construct($array = array()) {
        self::$array = $array;
    }
    
    public function opciones(){
        
    }
    
    public static function validate(){
        $datosForm = (object) self::$array;
        return $datosForm;
    }

    public static function getTipoUsuarios(){
        $Dao = new daoTipoUsuario();
        return $Dao->listar();        
    }
    
    public static function IdTipoUsuario(){
        $dao = new daoTipoUsuario();
        return $dao->Codigo();        
    }
    
    public static function grabar(){
        $datosForm = self::validate();
        $modelo = new TipoUsuario($datosForm->idTipoUsuario,$datosForm->descripcion,$datosForm->estado);
        $dao = new daoTipoUsuario();
        switch ($datosForm->opc){      
            case 'I': if($dao->crear($modelo)) return '{"ok":true}';                   
            default : if($dao->editar($modelo))return '{"ok":true}';
        }       
       return '{"error":"Ha ocurrido un Error al Grabar El Registro"}';
    } 
    
    public static function editar(){
        $datosForm = (object)self::$array;
        $dao = new daoTipoUsuario();
        $aJson = $dao->listarId($datosForm->id);  
        return json_encode($aJson);     
    }
    
     public static function eliminar(){
        $datosForm = self::validate();  
        $dao = new daoTipoUsuario();
        $modelo = new TipoUsuario($datosForm->id,"",0);      
        if($dao->delete($modelo)){
           return '{"ok":true}';
        }                
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';     
    }
}
