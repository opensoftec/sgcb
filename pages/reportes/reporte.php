<?php
ob_start();

date_default_timezone_set('America/Guayaquil');
require_once '../../lib/lib-report/mpdf.php';
require_once '../../clases/conexion/DataBase.php';
require_once '../../clases/modelo/OrdenIngreso.php';
require_once '../../clases/interfaces/Iordeningreso.php';
require_once '../../clases/dao/daoOrdenIngreso.php';

$id = intval($_GET['orden']);
$inicio = $_GET['inicio'];
$fin = $_GET['fin'];
$dao = new daoOrdenIngreso();
    
    
if ($id < 7){
    $data = $dao->Report_Orden($id,$inicio,$fin);
}else{
    $data = $dao->Report_Computadora($inicio,$fin);
}

$titulo = '';
switch ($id){
    case 1:
        echo $titulo = 'De Ordenes Entregadas'.' Desde '.$inicio.' hasta '.$fin;
        break;
    case 2:
        echo $titulo = 'De Ordenes Por Revisar'.' Desde '.$inicio.' hasta '.$fin;
        break;
    case 3:
        echo $titulo = 'De Ordenes Por Garantia'.' Desde '.$inicio.' hasta '.$fin;
        break;
    case 4:
        echo $titulo = 'De Ordenes De Servicio Externo'.' Desde '.$inicio.' hasta '.$fin;
        break;
    case 6:
        echo $titulo = 'De Ordenes En Revision'.' Desde '.$inicio.' hasta '.$fin;;
        break;
    case 5:
        echo $titulo = 'De Ordenes Por Entregar'.' Desde '.$inicio.' hasta '.$fin;
        break;
    case 7:
        echo $titulo = 'De Productos Ingresados';
        break;
}


$html = '
        <header><meta http-equiv="Content-Type" content="text/html; charset=big5">
            <style>@page {
                margin: 50px;
            }</style>
            <div>
                <div id="logo" align="center">
                    <img align="center" src="../../img/logo nombre.jpg">
                </div>
                <div id="company">
                    <div>Direccion: Esmeraldas 906 y Av. 17 de Septiembre</div>
                    <div>042711943 - 0985716152 - 0969600344 - 0992237259</div>
                    <div>E-mail: tecnicorlasic@gmail.com</div>
                </div>
            </div>
            <link rel="shortcut icon" href="../img/icono_1.jpg" type="image/png"/>
        </header>
        <main>
            <div><h1>Listado '.$titulo.'</h1></div>
            <table>
                <thead>
                    <tr>
                        ';

if ($id == 7 ){
    $c .='<th>#</th>
                        <th>#ORDEN</th>
                        <th>COMPUTADORA/CARACTERISTICAS</th>
                    </tr>
                </thead>
                <tbody>';
    foreach ($data as $obj){
        $c .= '<tr>
            <td>'.$obj->getIdOrdenIngreso().'</td>
            <td>'.$obj->getNumeroOrden().'</td>
            <td>'.$obj->getCaracteristicasEquipo().'</td>
        </tr>';
    }
}else if ($id == 5 ){
    $c .='<th>#</th>
                        <th>#ORDEN</th>
                        <th>INGRESO</th>
                        <th>ENTREGA</th>
                        <th>CLIENTE</th>
                        <th>FECHA ACTUAL</th>
                        <th># DIAS ATRASADOS</th>
                    </tr>
                </thead>
                <tbody>';
    $total = 0;
    $entregadas = 0;
    foreach ($data as $obj){
        $date1 = new DateTime($obj->getFechaEntrega());
        $date2 = new DateTime("now");
        $diff = $date1->diff($date2);
        
        $days = $diff->days;
        if ($diff->invert == 1 or $diff->days == 0 ){
            $days = 0;
            $entregadas += 1; 
        }
        
        $c .= '<tr>
            <td>'.$obj->getIdOrdenIngreso().'</td>
            <td>'.$obj->getNumeroOrden().'</td>
            <td>'.$obj->getFechaIngreso().'</td>
            <td>'.$obj->getFechaEntrega().'</td>
            <td>'.$obj->getApellidoCliente().' '.$obj->getNombleCliente().'</td>
            <td>'.$date2->format('Y-m-d').'</td>    
            <td>'.$days.'</td>
        </tr>';
        $total = $obj->getIdOrdenIngreso();
    }
}else{
    $c .='<th>#</th>
                        <th>#ORDEN</th>
                        <th>INGRESO</th>
                        <th>ENTREGA</th>
                        <th>CLIENTE</th>
                        <th>CARACTERISTICAS</th>
                        <th>TECNICO</th>
                        <th>TOTAL A PAGAR</th>
                    </tr>
                </thead>
                <tbody>';
    foreach ($data as $obj){
        $c .= '<tr>
            <td>'.$obj->getIdOrdenIngreso().'</td>
            <td>'.$obj->getNumeroOrden().'</td>
            <td>'.$obj->getFechaIngreso().'</td>
            <td>'.$obj->getFechaEntrega().'</td>
            <td>'.$obj->getApellidoCliente().' '.$obj->getNombleCliente().'</td>
            <td>'.$obj->getCaracteristicasEquipo().'</td>
            <td>'.$obj->getApellidoTecnico().' '.$obj->getNombreTecnico().'</td>
            <td>'.$obj->getTotalPagar().'</td>
        </tr>';
    }
}
$c .= '</tbody></table></main>';


if ($id == 5 ){
    $por = ($entregadas*100)/$total;
    $c.= '<div>
            Observacion : '.($total - $entregadas).' de '.$total.' Ordenes Atrasadas
            <br>
            # Ordenes Entregadas : '.round($por,2).'%
            <br>
            # Ordenes Atrasadas : '.round((100 - $por),2).'%
            <br>
          </div>
         ';
}
$html .= $c;

$mpdf = new mPDF('', 'A4');
$css = file_get_contents('../../css/report-orden.css');

$mpdf->WriteHTML($css, 1);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
$mpdf->WriteHTML($html);
$mpdf->Output('Reporte.pdf', 'I');