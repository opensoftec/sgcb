<?php
require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/DescuentoCliente.php';
require_once '../clases/interfaces/Idescuentocliente.php';
require_once '../clases/dao/daoDescuentoCliente.php';

class ctrDescuentoCliente {
    private static $array;
    
    public function __construct($array = array()) {
        self::$array = $array;
    }
    
    public static function validate(){
        $datosForm = (object) self::$array;
        return $datosForm;
    }

    public static function getDescuentoClientes(){
        $Dao = new daoDescuentoCliente();
        return $Dao->listar();        
    }
    
    public static function grabar(){
        $datosForm = self::validate();
        $modelo = new DescuentoCliente($datosForm->idDescuentoCliente,$datosForm->idCliente,$datosForm->descuento,$datosForm->estado);
        $dao = new daoDescuentoCliente();
        switch ($datosForm->opc){      
            case 'I': if($dao->crear($modelo)) return '{"ok":true}';                   
            default : if($dao->editar($modelo))return '{"ok":true}';
        }       
       return '{"error":"Ha ocurrido un Error al Grabar El Registro"}';
    } 
    
    public static function editar(){
        $datosForm = (object)self::$array;
        $dao = new daoDescuentoCliente();
        $aJson = $dao->listarId($datosForm->id);        
        if(count($aJson)){
           $aJson['ok']= true; 
           return json_encode($aJson);
        }        
        return '{"error":"Ha ocurrido un Error Al Seleccionar los Datos"}';     
    }
    
     public static function eliminar(){
        $datosForm = self::validate();  
        $dao = new daoDescuentoCliente();
        $modelo = new Marca($datosForm->id,0,"",0);      
        if($dao->delete($modelo)){
           return '{"ok":true}';
        }                
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';     
    }
    
}
