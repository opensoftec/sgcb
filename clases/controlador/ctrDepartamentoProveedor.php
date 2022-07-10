<?php
require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/DepartamentoProveedor.php';
require_once '../clases/interfaces/Idepartamentoproveedor.php';
require_once '../clases/dao/daoDepartamentoProveedor.php';
class ctrDepartamentoProveedor {
    private static $array;
    
    public function __construct($array = array()) {
        self::$array = $array;
    }
    
    public static function validate(){
        $datosForm = (object) self::$array;
        return $datosForm;
    }

    public static function getDepartamentosProveedores(){
        $Dao = new daoDepartamentoProveedor();
        return $Dao->listar();        
    }
    
    public static function grabar(){
        $datosForm = self::validate();
        $modelo = new DepartamentoProveedor($datosForm->idDepartamentoProveedor,$datosForm->descripcion,$datosForm->responsable,$datosForm->telefono,$datosForm->idProveedor,$datosForm->estado);
        $dao = new daoDepartamentoProveedor();
        switch ($datosForm->opc){      
            case 'I': if($dao->crear($modelo)) return '{"ok":true}';                   
            default : if($dao->editar($modelo))return '{"ok":true}';
        }       
       return '{"error":"Ha ocurrido un Error al Grabar El Registro"}';
    } 
    
    public static function editar(){
        $datosForm = (object)self::$array;
        $dao = new daoDepartamentoProveedor();
        $aJson = $dao->listarId($datosForm->id);        
        return json_encode($aJson);  
    }
    
     public static function eliminar(){
        $datosForm = self::validate();  
        $dao = new daoDepartamentoProveedor();
        $modelo = new DepartamentoProveedor($datosForm->id,"","","",0,0);      
        if($dao->delete($modelo)){
           return '{"ok":true}';
        }                
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';     
    }
}
