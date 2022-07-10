<?php

class daoProducto implements Iproducto {

    public function crear(\Producto $producto) {
        try {
            $sql = 'insert into tb_producto (serie,descripcion,precio,cantidad,idTipoServicio,idMarca,idProveedor,observacion,estado) values (:serie,:descripcion,:precio,:cantidad,:idtipo,:idmarca,:idproveedor,:observacion,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':serie', $producto->getSerie(), PDO::PARAM_STR);
            $stmp->bindParam(':descripcion', $producto->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':precio', $producto->getPrecio(), PDO::PARAM_INT);
            $stmp->bindParam(':cantidad', $producto->getCantidad(), PDO::PARAM_INT);
            $stmp->bindParam(':idtipo', $producto->getIdTipoServicio(), PDO::PARAM_INT);
            $stmp->bindParam(':idmarca', $producto->getIdMarca(), PDO::PARAM_INT);
            $stmp->bindParam(':idproveedor', $producto->getIdProveedor(), PDO::PARAM_INT);
            $stmp->bindParam(':observacion', $producto->getObservacion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $producto->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\Producto $producto) {
        try {
            $sql = 'UPDATE tb_producto SET estado=:estado WHERE idProducto = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $producto->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $producto->getIdProducto(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\Producto $producto) {
        try {
            $sql = 'UPDATE tb_producto SET serie=:serie,descripcion=:descripcion,precio=:precio,cantidad=:cantidad,idTipoServicio=:idtipo,idMarca=:idmarca,idProveedor=:idproveedor,observacion=:observacion WHERE idProducto = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $producto->getIdProducto(), PDO::PARAM_INT);
            $stmp->bindParam(':serie', $producto->getSerie(), PDO::PARAM_STR);
            $stmp->bindParam(':descripcion', $producto->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':precio', $producto->getPrecio(), PDO::PARAM_INT);
            $stmp->bindParam(':cantidad', $producto->getCantidad(), PDO::PARAM_INT);
            $stmp->bindParam(':idtipo', $producto->getIdTipoServicio(), PDO::PARAM_INT);
            $stmp->bindParam(':idmarca', $producto->getIdMarca(), PDO::PARAM_INT);
            $stmp->bindParam(':idproveedor', $producto->getIdProveedor(), PDO::PARAM_INT);
            $stmp->bindParam(':observacion', $producto->getObservacion(), PDO::PARAM_STR);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $productos = array();
        try {
            $sql = 'select p.idProducto, p.serie, p.descripcion, p.precio, p.cantidad, tp.descripcion tipoProductoDescripcion, m.descripcion marcaDescripcion, pr.nombre proveedorNombre, p.estado, p.observacion from tb_producto p , tb_tiposervicio tp, tb_marca m ,tb_proveedor pr where p.idTipoServicio = tp.idTipoServicio and p.idMarca = m.idMarca and p.idProveedor = pr.idProveedor';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $productos[] = new Producto($obj->idProducto, $obj->serie, $obj->descripcion, $obj->precio, $obj->cantidad, $obj->tipoProductoDescripcion, $obj->marcaDescripcion, $obj->proveedorNombre, $obj->observacion, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $productos;
    }

    public function listarId($idProducto) {
        $producto = null;
        try {
            $sql = 'SELECT * from tb_producto WHERE idProducto = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $idProducto, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $producto = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $producto;
    }

}
