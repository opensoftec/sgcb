<?php

class daoPieza implements Ipieza {

    public function crear(\Pieza $pieza) {
        try {
            $sql = 'insert into tb_pieza(serie,descripcion,precio,cantidad,idTipoServicio,idMarca,idProveedor,observacion,estado) values (:serie,:descripcion,:precio,:cantidad,:idtipo,:idmarca,:idproveedor,:observacion,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':serie', $pieza->getSerie(), PDO::PARAM_STR);
            $stmp->bindParam(':descripcion', $pieza->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':precio', $pieza->getPrecio(), PDO::PARAM_INT);
            $stmp->bindParam(':cantidad', $pieza->getCantidad(), PDO::PARAM_INT);
            $stmp->bindParam(':idtipo', $pieza->getIdTipoServicio(), PDO::PARAM_INT);
            $stmp->bindParam(':idmarca', $pieza->getIdMarca(), PDO::PARAM_INT);
            $stmp->bindParam(':idproveedor', $pieza->getIdProveedor(), PDO::PARAM_INT);
            $stmp->bindParam(':observacion', $pieza->getObservacion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $pieza->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\Pieza $pieza) {
        try {
            $sql = 'UPDATE tb_pieza SET estado=:estado WHERE idPieza = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $pieza->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $pieza->getIdPieza(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\Pieza $pieza) {
        try {
            $sql = 'UPDATE tb_pieza SET serie=:serie,descripcion=:descripcion,precio=:precio,cantidad=:cantidad,idTipoServicio=:idtipo,idMarca=:idmarca,idProveedor=:idproveedor,observacion=:observacion,estado=:estado WHERE idPieza= :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $pieza->getIdPieza(), PDO::PARAM_INT);
            $stmp->bindParam(':serie', $pieza->getSerie(), PDO::PARAM_STR);
            $stmp->bindParam(':descripcion', $pieza->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':precio', $pieza->getPrecio(), PDO::PARAM_INT);
            $stmp->bindParam(':cantidad', $pieza->getCantidad(), PDO::PARAM_INT);
            $stmp->bindParam(':idtipo', $pieza->getIdTipoServicio(), PDO::PARAM_INT);
            $stmp->bindParam(':idmarca', $pieza->getIdMarca(), PDO::PARAM_INT);
            $stmp->bindParam(':idproveedor', $pieza->getIdProveedor(), PDO::PARAM_INT);
            $stmp->bindParam(':observacion', $pieza->getObservacion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $pieza->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $piezas = array();
        try {
            $sql = 'select p.idPieza, p.serie, p.descripcion, p.precio, p.cantidad, tp.descripcion tipoProductoDescripcion, m.descripcion marcaDescripcion, pr.nombre proveedorNombre, p.observacion, p.estado from tb_pieza p , tb_tiposervicio tp, tb_marca m ,tb_proveedor pr where p.idTipoServicio = tp.idTipoServicio and p.idMarca = m.idMarca and p.idProveedor = pr.idProveedor';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $piezas[] = new Pieza($obj->idPieza, $obj->serie, $obj->descripcion, $obj->precio, $obj->cantidad, $obj->tipoProductoDescripcion, $obj->marcaDescripcion, $obj->proveedorNombre, $obj->observacion, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $piezas;
    }

    public function listarId($idPieza) {
        $pieza = null;
        try {
            $sql = 'SELECT * from tb_pieza WHERE idPieza = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $idPieza, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $pieza = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $pieza;
    }

}
