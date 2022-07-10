<?php
require_once '../clases/conexion/DataBase.php';
require_once '../clases/modelo/Pieza.php';
require_once '../clases/interfaces/Ipieza.php';
require_once '../clases/dao/daoPieza.php';
class ctrPieza {
    private static $array;
    
    public function __construct($array = array()) {
        self::$array = $array;
    }
        
    public static function validate(){
        $datosForm = (object) self::$array;
        return $datosForm;
    }
    
    public static function getPiezas(){
        $Dao = new daoPieza();
        return $Dao->listar();        
    }

     public static function grabar(){
        $datosForm = self::validate();
        $modelo = new Pieza($datosForm->idPieza,$datosForm->serie,$datosForm->descripcion,$datosForm->precio,$datosForm->cantidad,$datosForm->idTipoProducto,$datosForm->idMarca,$datosForm->idProveedor,$datosForm->observacion,$datosForm->estado);
        $dao = new daoPieza();
        switch ($datosForm->opc){      
            case 'I': if($dao->crear($modelo)) return '{"ok":true}';                   
            default : if($dao->editar($modelo))return '{"ok":true}';
        }       
       return '{"error":"Ha ocurrido un Error al Grabar El Registro"}';
    } 
    
    public static function editar(){
        $datosForm = (object)self::$array;
        $dao = new daoPieza();
        $aJson = $dao->listarId($datosForm->id);         
        return json_encode($aJson);
    }
    
     public static function eliminar(){
        $datosForm = self::validate();  
        $dao = new daoPieza;
        $modelo = new Pieza($datosForm->id,"","",0.0,0,0,0,0,"",0);      
        if($dao->delete($modelo)){
           return '{"ok":true}';
        }                
        return '{"error":"Ha ocurrido un Error Al Eliminar los Datos"}';     
    }
}
