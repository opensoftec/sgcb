<?php
require '../clases/controlador/ctrOrdenIngreso.php';
$texto = '';
$registros = '';
if($_POST){
  $busqueda = $_POST['numeroorden'];
  $entero = 0;
    if (empty($busqueda)){
	  $texto = 'Búsqueda sin resultados';
    }else{
      	  $orden = new ctrOrdenIngreso($_POST);
          $sOrden = $orden->buscarOrdenCliente($_POST['numeroorden'],$_POST['clave']);
            if (count($sOrden)){ 
                $dato = (object) $sOrden;
                $registros='<div class="panel-body">
                                <table class="table table-hover table-bordered table-responsive table-striped" id="tdatos">
                                    <thead>
                                        <tr>
                                            <th>Orden</th>
                                            <th>Maquina</th>
                                            <th>Cumplimiento</th>
                                            <th>Tecnico</th>
                                            <th>Fecha Entrega</th>
                                            <th>Estado</th>
                                            <th>Pago</th>
                                        </tr> 
                                    </thead>
                                    <tbody id="tdetalle">
                                                <tr>                                           
                                                    <td align="center">'  .$dato->numeroOrden. '</td>
                                                    <td align="center">'  .$dato->caracteristicasEquipo. '</td>    
                                                    <td align="center">'  .$dato->cumplimiento. '</td>
                                                    <td align="center">'  .$dato->nombreTecnico. ' ' .$dato->apellidoTecnico. '</td> 
                                                    <td align="center">'  .$dato->fechaEntrega. '</td>   
                                                    <td align="center">'  .$dato->Estado. '</td> 
                                                    <td align="center">'  .$dato->totalPagar. '</td> 
                                                </tr>   
                                    </tbody>
                                </table>
                            </div>';  
            }else{
                $texto = "El numero de orden o la clave no son correctas";	
            }
    }
}
?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Buscar Orden</title>
        <link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        //<?php include "principaltopbuscar.php" ?>
        <article id="content"> 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row-fluid">
                            <div class="span12">
                                <ul class="breadcrumb">
                                    <li><a href="principal.php">Inicio</a><span class="divider"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-offset-2">
                        <div class="lock-screen-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h2>Consulta tu Orden</h2>
                                    
                                </div>
                                <div class="panel-body">
                                    <form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                                        <input class="form-control" id="_modo" name="modo" type="hidden" />
                                        <fieldset>
                                            <label>#Orden</label>
                                            <input type="text" id="_numeroorden" name="numeroorden" class="form-control" placeholder="Ingresa el número de tu orden" required="true" autofocus>
                                            <label>Clave</label>
                                            <input type="password" id="_clave" name="clave" class="form-control" placeholder="Tu clave son los 4 primeros digitos de tu cedula " required="true">               
                                        </fieldset>
                                            </div>
                                        <div class="panel-body">
                                            <div class="panel" id="respuesta">
                                                <p><?php echo $texto;
                                                    echo $registros; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="panel panel-footer">
                                            <button id="buscar" type="submit" name="buscar" class="btn btn-success">
                                                <span class="glyphicon glyphicon-log-in"></span> Buscar
                                            </button>
                                            <button type="button" class="btn btn-danger" id="cancelar" onclick="window.location = '/sistema/pages/principal.php'">
                                                <span class="glyphicon glyphicon-circle-arrow-left"></span> Salir
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <footer>
        </footer>
        <script src="../lib/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
