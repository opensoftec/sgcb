<?php

require_once '../../lib/lib-report/mpdf.php';
require_once '../../clases/conexion/DataBase.php';
require_once '../../clases/interfaces/Iordeningreso.php';
require_once '../../clases/dao/daoOrdenIngreso.php';


$id = $_GET['num'];
$dao = new daoOrdenIngreso();
$data = $dao->Reporte($id);


$html = '
        <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <style>@page {
                margin: 20px;
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
            <div><h2 class="name" align="right"><b>Orden Nº : ' . $data->numeroOrden . '</b></h2></div>
            <div id="details">
                <div id="client">
                    <div>Datos del Docente</div>
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
                        <td height="50" >' . $data->caracteristicasEquipo . '</td>
                    </tr>
                </tbody>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" class="table fija"> 
                <thead>
                    <tr>
                        <th width="400" colspan="2">Antecedentes:</th>
                        <th width="400" colspan="2">Observaciones:</th>
                    </tr> 
                </thead>
                <tbody>
                    <tr>
                        <td width="400" height="100" colspan="2">' . $data->antecedenteIngreso . '</td>
                        <td width="400" height="100" colspan="2">' . $data->observacion . '</td>
                    </tr>
                    <tr>
                        <td><strong>Fecha Ingreso:</strong></td>
                        <td>' . $data->fechaIngreso . '</td>
                        <td  rowspan="3"></td>
                        <td  rowspan="3"></td>
                    </tr>
                    <tr>
                        <td><strong>Fecha Entrega:</strong></td>
                        <td>' . $data->fechaEntrega . '</td>
                    </tr>
                    <tr>
                        <td><strong>Etapa:</strong></td>
                        <td>Recepcion</td>
                    </tr>
                    <tr>
                        <td><strong>Tecnico:</strong></td>
                        <td>' . $data->apellidoTecnico . ' ' . $data->nombreTecnico . '</td>
                        <td><strong>Firma Asesor de Servicio</strong></td>
                        <td><strong>Firma del Cliente</strong></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="justificado"><strong>NOTA:<BR>*Guardar el comprobante como recibo de entrega del equipo.<br>*ISTJBA - 2020</strong></td>
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
