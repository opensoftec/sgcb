<?php
ob_start();

date_default_timezone_set('America/Guayaquil');
require_once '../../lib/lib-report/mpdf.php';
require_once '../../clases/conexion/DataBase.php';
require_once '../../clases/modelo/OrdenIngreso.php';
require_once '../../clases/interfaces/Iordeningreso.php';
require_once '../../clases/dao/daoOrdenIngreso.php';
require_once '../../clases/modelo/Bien.php';

$codigo = intval($_GET['orden']);
$dao = new daoOrdenIngreso();
$data = $dao->reporte_bien($codigo);
$id = 5;
$categoria = '';
foreach ($data as $obj){
    $categoria= $obj->getBien();
}
$titulo = '';
echo $titulo = 'REPORTE DE BIENES '. $categoria .'' ;


$html = '
        <header><meta http-equiv="Content-Type" content="text/html; charset=big5">
            <style>@page {
                margin: 50px;
            }</style>
            <div>
                <div id="logo" align="center">
                    <img align="center" src="../../img/icono_1.png">
                </div>
                <div id="company">
                    <div>Sede Principal KM. 48 Vía Santa Lucia Diagonal A Gasolinera Primax.</div>
                    <div>Iitsjba.Secretaria@Gmail.Com</div>
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
                        <th>CÓDIGO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>SERIE</th>
                        <th>MODELO</th>
                        <th>MARCA</th>
                        <th>UBICACIÓN</th>
                    </tr>
                </thead>
                <tbody>';
    foreach ($data as $obj){
        $c .= '<tr>
            <td>'.$obj->getNumero().'</td>
            <td>'.$obj->getCodigo().'</td>
            <td>'.$obj->getDescripcion().'</td>
            <td>'.$obj->getSerie().'</td>
            <td>'.$obj->getModelo().'</td>
            <td>'.$obj->getMarca().'</td>
            <td>'.$obj->getUbicacion().'</td>
        </tr>';
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


$html .= $c;

$mpdf = new mPDF('', 'A4');
$css = file_get_contents('../../css/report-orden.css');

$mpdf->WriteHTML($css, 1);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
$mpdf->WriteHTML($html);
$mpdf->Output('Reporte.pdf', 'I');