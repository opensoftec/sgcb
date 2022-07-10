<?php

class daoOrdenIngreso implements Iordeningreso {

    public function numeroOrden() {
        $codigo = "";
        try {
            $sql = 'SELECT (MAX(oi1.numeroOrden)+1) codigo from tb_orden_ingreso oi1';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $codigo = $obj->codigo;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $codigo;
    }

    public function fechaActual() {
        $fecha = date("Y") . "/" . date("m") . "/" . date("d");
        return $fecha;
    }

    public function crear(\OrdenIngreso $ordenIngreso) {
        try {
            $sql = 'insert into tb_orden_ingreso (numeroOrden,fechaIngreso,idCliente,caracteristicasEquipo,antecedenteIngreso,observacion,fechaEntrega,idTecnico,estado,subtotal,iva,descuento,totalPagar)'
                    . ' values (:numero,:fechaingreso,:idcliente,:caracteristica,:antecedente,:observacion,:fechaentrega,:idtecnico,:estado,:subtotal,:iva,:descuento,:total)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':numero', $ordenIngreso->getNumeroOrden(), PDO::PARAM_INT);
            $stmp->bindParam(':fechaingreso', $ordenIngreso->getFechaIngreso(), PDO::PARAM_STR);
            $stmp->bindParam(':idcliente', $ordenIngreso->getIdCliente(), PDO::PARAM_INT);
            $stmp->bindParam(':caracteristica', $ordenIngreso->getCaracteristicasEquipo(), PDO::PARAM_STR);
            $stmp->bindParam(':antecedente', $ordenIngreso->getAntecedenteIngreso(), PDO::PARAM_STR);
            $stmp->bindParam(':observacion', $ordenIngreso->getObservacion(), PDO::PARAM_STR);
            $stmp->bindParam(':fechaentrega', $ordenIngreso->getFechaEntrega(), PDO::PARAM_STR);
            $stmp->bindParam(':idtecnico', $ordenIngreso->getIdTecnico(), PDO::PARAM_INT);
            $stmp->bindParam(':estado', $ordenIngreso->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':subtotal', $ordenIngreso->getSubtotal(), PDO::PARAM_INT);
            $stmp->bindParam(':iva', $ordenIngreso->getIva(), PDO::PARAM_INT);
            $stmp->bindParam(':descuento', $ordenIngreso->getDescuento(), PDO::PARAM_INT);
            $stmp->bindParam(':total', $ordenIngreso->getTotalPagar(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function crearCumplimiento(\OrdenIngreso $ordenIngreso) {
        try {
            $sql = 'insert into tb_orden_ingreso (numeroOrden,fechaIngreso,idCliente,caracteristicasEquipo,antecedenteIngreso,observacion,fechaEntrega,idTecnico,estado,cumplimiento,observacionTecnico) '
                    . 'values (:numero,:fechaingreso,:idcliente,:caracteristica,:antecedente,:observacion,:fechaentrega,:idtecnico,:estado,:cumplimiento,:observaciontecnico)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':numero', $ordenIngreso->getNumeroOrden(), PDO::PARAM_INT);
            $stmp->bindParam(':fechaingreso', $ordenIngreso->getFechaIngreso(), PDO::PARAM_STR);
            $stmp->bindParam(':idcliente', $ordenIngreso->getIdCliente(), PDO::PARAM_INT);
            $stmp->bindParam(':caracteristica', $ordenIngreso->getCaracteristicasEquipo(), PDO::PARAM_STR);
            $stmp->bindParam(':antecedente', $ordenIngreso->getAntecedenteIngreso(), PDO::PARAM_STR);
            $stmp->bindParam(':observacion', $ordenIngreso->getObservacion(), PDO::PARAM_STR);
            $stmp->bindParam(':fechaentrega', $ordenIngreso->getFechaEntrega(), PDO::PARAM_STR);
            $stmp->bindParam(':idtecnico', $ordenIngreso->getIdTecnico(), PDO::PARAM_INT);
            $stmp->bindParam(':estado', $ordenIngreso->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':cumplimiento', $ordenIngreso->getCumplimiento(), PDO::PARAM_STR);
            $stmp->bindParam(':observaciontecnico', $ordenIngreso->getObservacionTecnico(), PDO::PARAM_STR);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\OrdenIngreso $ordenIngreso) {
        try {
            $sql = 'UPDATE tb_orden_ingreso SET estadoOrden=:estado WHERE idOrdenIngreso = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $ordenIngreso->getEstadoOrden(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $ordenIngreso->getIdOrdenIngreso(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\OrdenIngreso $ordenIngreso) {
        try {
            $sql = 'UPDATE tb_orden_ingreso SET fechaIngreso=:fechaingreso,idCliente=:idcliente,caracteristicasEquipo=:caracteristica,antecedenteIngreso=:antecedente,observacion=:observacion,fechaEntrega=:fechaentrega,idTecnico=:idtecnico,estado=:estado,totalPagar=:totalpagar WHERE idOrdenIngreso = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':fechaingreso', $ordenIngreso->getFechaIngreso(), PDO::PARAM_STR);
            $stmp->bindParam(':idcliente', $ordenIngreso->getIdCliente(), PDO::PARAM_INT);
            $stmp->bindParam(':caracteristica', $ordenIngreso->getCaracteristicasEquipo(), PDO::PARAM_STR);
            $stmp->bindParam(':antecedente', $ordenIngreso->getAntecedenteIngreso(), PDO::PARAM_STR);
            $stmp->bindParam(':observacion', $ordenIngreso->getObservacion(), PDO::PARAM_STR);
            $stmp->bindParam(':fechaentrega', $ordenIngreso->getFechaEntrega(), PDO::PARAM_STR);
            $stmp->bindParam(':idtecnico', $ordenIngreso->getIdTecnico(), PDO::PARAM_INT);
            $stmp->bindParam(':estado', $ordenIngreso->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':totalpagar', $ordenIngreso->getTotalPagar(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $ordenIngreso->getIdOrdenIngreso(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editarCumplimientoTecnico(\OrdenIngreso $ordenIngreso) {
        try {
            $sql = 'UPDATE tb_orden_ingreso SET estado=:estado,cumplimiento=:cumplimiento,observacionTecnico=:observaciontecnico WHERE idOrdenIngreso = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $ordenIngreso->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':cumplimiento', $ordenIngreso->getCumplimiento(), PDO::PARAM_STR);
            $stmp->bindParam(':observaciontecnico', $ordenIngreso->getObservacionTecnico(), PDO::PARAM_STR);
            $stmp->bindParam(':id', $ordenIngreso->getIdOrdenIngreso(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editarPagoAdministrador(\OrdenIngreso $ordenIngreso) {
        try {
            $sql = 'UPDATE tb_orden_ingreso SET estado=:estado,subtotal=:subtotal,descuento=:descuento, totalPagar=:total, estadoPago=:estadopago WHERE idOrdenIngreso = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $ordenIngreso->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':subtotal', $ordenIngreso->getSubtotal(), PDO::PARAM_INT);
            $stmp->bindParam(':descuento', $ordenIngreso->getDescuento(), PDO::PARAM_INT);
            $stmp->bindParam(':total', $ordenIngreso->getTotalPagar(), PDO::PARAM_INT);
            $stmp->bindParam(':estadopago', $ordenIngreso->getEstadoPago(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $ordenIngreso->getIdOrdenIngreso(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $ordenesIngreso = array();
        try {
            $sql = 'select oi.idOrdenIngreso, oi.numeroOrden, oi.fechaIngreso, u1.nombre as nombreCliente, u1.apellido as apellidoCliente, u1.direccion as direccionCliente, u1.telefono as telefonoCliente, oi.caracteristicasEquipo, oi.antecedenteIngreso, oi.observacion, oi.fechaEntrega, u2.nombre as nombreTecnico, u2.apellido as apellidoTecnico, oi.estado, oi.estadoOrden from tb_orden_ingreso oi, tb_usuario u1, tb_usuario u2 where oi.idCliente=u1.idUsuario and oi.idTecnico = u2.idUsuario';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $ordenesIngreso[] = new OrdenIngreso($obj->idOrdenIngreso, $obj->numeroOrden, $obj->fechaIngreso, 0, $obj->caracteristicasEquipo, $obj->antecedenteIngreso, $obj->observacion, $obj->fechaEntrega, 0, $obj->estado, $obj->nombreCliente, $obj->apellidoCliente, $obj->direccionCliente, $obj->telefonoCliente, $obj->nombreTecnico, $obj->apellidoTecnico, "", "", "", "", "", "", "", $obj->estadoOrden);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $ordenesIngreso;
    }

    public function listarOrdenTecnico($id) {
        $ordenesIngreso = array();
        try {
            $sql = 'select oi.idOrdenIngreso, oi.numeroOrden, oi.fechaIngreso, u1.nombre as nombreCliente, u1.apellido as apellidoCliente, u1.direccion as direccionCliente, u1.telefono as telefonoCliente, oi.caracteristicasEquipo, oi.antecedenteIngreso, oi.observacion, oi.fechaEntrega, oi.estado, oi.cumplimiento, oi.observacionTecnico, oi.estadoOrden from tb_orden_ingreso oi, tb_usuario u1 where oi.idCliente=u1.idUsuario and oi.idTecnico = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $ordenesIngreso[] = new OrdenIngreso($obj->idOrdenIngreso, $obj->numeroOrden, $obj->fechaIngreso, 0, $obj->caracteristicasEquipo, $obj->antecedenteIngreso, $obj->observacion, $obj->fechaEntrega, 0, $obj->estado, $obj->nombreCliente, $obj->apellidoCliente, $obj->direccionCliente, $obj->telefonoCliente, "", "", $obj->cumplimiento, $obj->observacionTecnico, "", "", "", "", "", $obj->estadoOrden);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $ordenesIngreso;
    }

//    public function listarOrdenCliente($id) {
//        $ordenesIngreso = array();
//        try {
//            $sql = 'select oi.idOrdenIngreso, oi.numeroOrden, oi.fechaIngreso, u1.nombre as nombreCliente, u1.apellido as apellidoCliente, u1.direccion as direccionCliente, u1.telefono as telefonoCliente, oi.caracteristicasEquipo, oi.antecedenteIngreso, oi.observacion, oi.fechaEntrega, oi.estado, oi.cumplimiento, oi.observacionTecnico, oi.estadoOrden, oi.totalPagar from tb_orden_ingreso oi, tb_usuario u1 where oi.idTecnico = u1.idUsuario and oi.idCliente= :id';
//            $cn = DataBase::getInstancia();
//            $stmp = $cn->prepare($sql);
//            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
//            $stmp->execute();
//            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
//                $ordenesIngreso[] = new OrdenIngreso($obj->idOrdenIngreso, $obj->numeroOrden, $obj->fechaIngreso, 0, $obj->caracteristicasEquipo, $obj->antecedenteIngreso, $obj->observacion, $obj->fechaEntrega, 0, $obj->estado, $obj->nombreCliente, $obj->apellidoCliente, $obj->direccionCliente, $obj->telefonoCliente, "", "", $obj->cumplimiento, $obj->observacionTecnico, "", "", "",$obj->totalPagar, "", $obj->estadoOrden);
//            }
//        } catch (PDOException $ex) {
//            echo $ex->getMessage();
//        }
//        return $ordenesIngreso;
//    }

    public function listarOrdenCliente($numeroOrden, $clave) {
        $ordenesIngreso = array();
        try {
            $sql = 'select oi.idOrdenIngreso, oi.numeroOrden, oi.fechaIngreso, u1.nombre as nombreTecnico, u1.apellido as apellidoTecnico, u1.direccion as direccionCliente, u1.telefono as telefonoCliente, oi.caracteristicasEquipo, oi.antecedenteIngreso,oi.observacion, oi.fechaEntrega, CASE WHEN oi.estado = 1 THEN "Entregado" WHEN oi.estado = 2 THEN "Por Revisar" WHEN oi.estado = 3 THEN "Garantia" WHEN oi.estado = 4 THEN "Serv. Ext." WHEN oi.estado = 5 THEN "Por Entregar" WHEN oi.estado = 6 THEN "Revision" END as Estado, oi.cumplimiento, oi.observacionTecnico, oi.estadoOrden, oi.totalPagar from tb_orden_ingreso oi, tb_usuario u1, tb_usuario u2 where oi.idTecnico = u1.idUsuario and oi.numeroOrden = :numeroOrden and u2.idUsuario = oi.idCliente and u2.contrasena = :clave';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':numeroOrden', $numeroOrden, 5);
            $stmp->bindParam(':clave', $clave, 5);
            $stmp->execute();
            if (($u = $stmp->fetch(PDO::FETCH_OBJ))) {
                $ordenesIngreso = $u;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $ordenesIngreso;
    }

    public function listarOrdenAdministrador() {
        $ordenesIngreso = array();
        try {
            $sql = 'select oi.idOrdenIngreso, oi.numeroOrden, oi.fechaIngreso, u1.nombre as nombreCliente, u1.apellido as apellidoCliente, u1.direccion as direccionCliente, u1.telefono as telefonoCliente, oi.caracteristicasEquipo, oi.antecedenteIngreso, oi.observacion, oi.fechaEntrega, u2.nombre as nombreTecnico, u2.apellido as apellidoTecnico, oi.estado, oi.cumplimiento, oi.observacionTecnico, oi.subtotal, oi.iva, oi.descuento, oi.totalPagar, oi.estadoPago, oi.estadoOrden from tb_orden_ingreso oi, tb_usuario u1, tb_usuario u2 where oi.idCliente=u1.idUsuario and oi.idTecnico = u2.idUsuario';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $ordenesIngreso[] = new OrdenIngreso($obj->idOrdenIngreso, $obj->numeroOrden, $obj->fechaIngreso, 0, $obj->caracteristicasEquipo, $obj->antecedenteIngreso, $obj->observacion, $obj->fechaEntrega, 0, $obj->estado, $obj->nombreCliente, $obj->apellidoCliente, $obj->direccionCliente, $obj->telefonoCliente, $obj->nombreTecnico, $obj->apellidoTecnico, $obj->cumplimiento, $obj->observacionTecnico, $obj->subtotal, $obj->iva, $obj->descuento, $obj->totalPagar, $obj->estadoPago, $obj->estadoOrden);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $ordenesIngreso;
    }

    public function listarId($id) {
        $ordenIngreso = null;
        try {
            $sql = 'select * from  tb_orden_ingreso oi where oi.idOrdenIngreso = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $ordenIngreso = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $ordenIngreso;
    }

    public function Reporte($id) {
        $ordenIngreso = array();
        try {
            $sql = 'select oi.idOrdenIngreso, oi.numeroOrden, oi.fechaIngreso, u1.nombre as nombreCliente, u1.apellido as apellidoCliente, u1.direccion as direccionCliente, u1.telefono as telefonoCliente, u1.correo as correoCliente, oi.caracteristicasEquipo, oi.antecedenteIngreso, oi.observacion, oi.fechaEntrega, u2.nombre as nombreTecnico, u2.apellido as apellidoTecnico, oi.estado, oi.subtotal, oi.iva, oi.descuento, oi.totalPagar, oi.cumplimiento  from tb_orden_ingreso oi, tb_usuario u1, tb_usuario u2 where oi.idCliente=u1.idUsuario and oi.idTecnico = u2.idUsuario and oi.idOrdenIngreso = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $ordenIngreso = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $ordenIngreso;
    }

    public function Report_Orden($id, $inicio, $fin) {
        $cont = 1;
        $ordenesIngreso = array();
        try {
            $sql = 'select oi.idOrdenIngreso, oi.numeroOrden, oi.fechaIngreso, u1.nombre as nombreCliente, u1.apellido as apellidoCliente, u1.direccion as direccionCliente, u1.telefono as telefonoCliente, u1.correo as correoCliente, oi.caracteristicasEquipo, oi.antecedenteIngreso, oi.observacion, oi.fechaEntrega, u2.nombre as nombreTecnico, u2.apellido as apellidoTecnico, oi.estado, oi.subtotal, oi.iva, oi.descuento, oi.totalPagar, oi.cumplimiento  from tb_orden_ingreso oi, tb_usuario u1, tb_usuario u2 where oi.idCliente=u1.idUsuario and oi.idTecnico = u2.idUsuario and oi.estado = :id and oi.fechaIngreso BETWEEN :inicio and :fin order by oi.fechaIngreso';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
            $stmp->bindParam(':inicio', $inicio, PDO::PARAM_INT);
            $stmp->bindParam(':fin', $fin, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $ordenesIngreso[] = new OrdenIngreso($cont, $obj->numeroOrden, $obj->fechaIngreso, 0, $obj->caracteristicasEquipo, $obj->antecedenteIngreso, $obj->observacion, $obj->fechaEntrega, 0, $obj->estado, $obj->nombreCliente, $obj->apellidoCliente, $obj->direccionCliente, $obj->telefonoCliente, $obj->nombreTecnico, $obj->apellidoTecnico, $obj->cumplimiento, $obj->observacionTecnico, $obj->subtotal, $obj->iva, $obj->descuento, $obj->totalPagar, $obj->estadoPago, $obj->estadoOrden);
                $cont += 1;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $ordenesIngreso;
    }

    public function Report_Computadora($inicio, $fin) {
        $cont = 1;
        $ordenesIngreso = array();
        try {
            $sql = 'select oi.idOrdenIngreso, oi.numeroOrden, oi.fechaIngreso, u1.nombre as nombreCliente, u1.apellido as apellidoCliente, u1.direccion as direccionCliente, u1.telefono as telefonoCliente, u1.correo as correoCliente, oi.caracteristicasEquipo, oi.antecedenteIngreso, oi.observacion, oi.fechaEntrega, u2.nombre as nombreTecnico, u2.apellido as apellidoTecnico, oi.estado, oi.subtotal, oi.iva, oi.descuento, oi.totalPagar, oi.cumplimiento  from tb_orden_ingreso oi, tb_usuario u1, tb_usuario u2 where oi.idCliente=u1.idUsuario and oi.idTecnico = u2.idUsuario and estadoOrden = 1 and oi.fechaEntrega BETWEEN :inicio and :fin order by oi.fechaIngreso';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':inicio', $inicio, PDO::PARAM_STR);
            $stmp->bindParam(':fin', $fin, PDO::PARAM_STR);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $ordenesIngreso[] = new OrdenIngreso($cont, $obj->numeroOrden, $obj->fechaIngreso, 0, $obj->caracteristicasEquipo, $obj->antecedenteIngreso, $obj->observacion, $obj->fechaEntrega, 0, $obj->estado, $obj->nombreCliente, $obj->apellidoCliente, $obj->direccionCliente, $obj->telefonoCliente, $obj->nombreTecnico, $obj->apellidoTecnico, $obj->cumplimiento, $obj->observacionTecnico, $obj->subtotal, $obj->iva, $obj->descuento, $obj->totalPagar, $obj->estadoPago, $obj->estadoOrden);
                $cont += 1;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $ordenesIngreso;
    }

    public function reporte_bien($id) {
        //Defino el array de información
        $bienes = array();
        try {
            $sql = 'select  @i := @i + 1 as numero, p.serie as codigo, p.descripcion as descripcion, p.precio as serie, p.cantidad as modelo , m.descripcion as marca, p.observacion as ubicacion, t.descripcion as bien from tb_producto p
            cross join (select @i := 0) r
            inner join tb_tiposervicio t on p.idTipoServicio = t.idTipoServicio
            inner join tb_marca m on p.idMarca = m.idMarca
            where p.idTipoServicio = :id
            group by p.idProducto';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $bienes[] = new Bien($obj->numero, $obj->codigo, $obj->descripcion, $obj->serie, $obj->modelo, $obj->marca, $obj->ubicacion, $obj->bien);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $bienes;
    }

}
