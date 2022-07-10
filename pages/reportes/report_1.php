<?php

require_once '../../lib/lib-report/mpdf.php';
require_once '../../clases/conexion/DataBase.php';
require_once '../../clases/interfaces/Iordeningreso.php';
require_once '../../clases/dao/daoOrdenIngreso.php';

$id = $_GET['num'];
$dao = new daoOrdenIngreso();
$data = $dao->Reporte($id);


$html = '
        <header>
            <style>@page {
                margin: 20px;
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
            <div><h2 class="name" align="right"><b>Orden Nº : ' . $data->numeroOrden . '</b></h2></div>
            <div id="details">
                <div id="client">
                    <div>Datos del cliente</div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0" class="table fija"> 
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direcion</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody class="body">
                     <tr>
                        <td width="25%" height="5">' . $data->apellidoCliente . ' ' . $data->nombreCliente . '</td>
                        <td width="25%" height="5">' . $data->telefonoCliente . '</td>
                        <td width="25%" height="5">' . $data->direccionCliente . '</td>
                        <td width="25%" height="5">' . $data->correoCliente . '</td>
                    </tr>
                </tbody>
            </table>
            <div id="details">
                <div id="client">
                    <div>Descripcion del Equipo</div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0" class="table fija"> 
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td height="50" >'.$data->caracteristicasEquipo . '</td>
                    </tr>
                </tbody>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" class="table fija"> 
                <thead>
                    <tr>
                        <th width="400" colspan="2">Cumplimiento:</th>
                        <th width="400" colspan="2">Costo:</th>
                    </tr> 
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" rowspan="9" >'.$data->cumplimiento . '</td>
                        <td><Strong>Subtotal: </Strong></td>
                        <td>'.$data->subtotal . '</td>
                    </tr>
                    <tr>
                        <td><Strong>Descuento: </Strong></td>
                        <td>'.$data->descuento . ' %</td>
                    </tr>
                    <tr>
                        <td><Strong>Total</Strong></td>
                        <td>'.$data->totalPagar . '</td>
                    </tr>
                    <tr>
                        <td colspan="2" height="15"><strong></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Fecha Entrega:</strong></td>
                        <td>'.$data->fechaEntrega . '</td>
                    </tr>
                    <tr>
                        <td><strong>Etapa:</strong></td>
                        <td>Entrega</td>
                    </tr>
                    <tr>
                        <td><strong>Tecnico:</strong></td>
                        <td>'.$data->apellidoTecnico . ' '.$data->nombreTecnico . '</td>
                    </tr>
                    <tr>
                        <td  height="25"></td>
                        <td  height="25"></td>
                    </tr>
                    <tr>
                        <td><strong>Firma Asesor de Servicio</strong></td>
                        <td><strong>Firma del Cliente</strong></td>
                    </tr>
                </tbody>
            </table>
        </main>
';

$mpdf = new mPDF('', 'A4');
$css = file_get_contents('../../css/report.css');

$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html);
$mpdf->Output('Reporte.pdf', 'I');