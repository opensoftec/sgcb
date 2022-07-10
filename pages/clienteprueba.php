<?php
require '../clases/controlador/ctrOrdenIngreso.php';
//Variable que contendrá el resultado de la búsqueda
$texto = '';
//Variable que contendrá el número de resgistros encontrados
$registros = '';
if($_POST){
  $busqueda = $_POST['buscar'];
  $entero = 0;
    if (empty($busqueda)){
	  $texto = 'Búsqueda sin resultados';
    }else{
      	  $orden = new ctrOrdenIngreso($_POST);
          $sOrden = $orden->buscarOrdenCliente($_POST['buscar'],'0942');
            if (count($sOrden)){ 
                $dato = (object) $sOrden;
                $registros = '<p>HEMOS ENCONTRADO ' . $dato->idOrdenIngreso . ' registros </p>';
            }else{
                $texto = "NO HAY RESULTADOS EN LA BBDD";	
            }
    }
}
?>
<!DOCTYPE html>
<html lang="es-ES">
<head> 
<meta charset='utf-8'>
<head> 
<body>
<h1>Ejemplo de buscador: by <a href="http://webreunidos.es" title="Más tutoriales en nuestra web" target="_self">webreunidos.es</a></h1> 
<form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
    <input id="buscar" name="buscar" type="search" placeholder="Buscar aquí..." autofocus >
    <input type="submit" name="buscador" class="boton peque aceptar" value="buscar">
</form>
<?php 
// Resultado, número de registros y contenido.
echo $registros;
echo $texto; 
?>
</body>
</html>
