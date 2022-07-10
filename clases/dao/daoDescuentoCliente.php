<?php

class daoDescuentoCliente implements Idescuentocliente {

    public function crear(\DescuentoCliente $descuentoCliente) {
        try {
            $sql = 'insert into tb_descuento_cliente (idCliente,descuento,estado) values (:idcliente,:descuento,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':idcliente', $descuentoCliente->getIdCliente(), PDO::PARAM_INT);
            $stmp->bindParam(':descuento', $descuentoCliente->getDescuento(), PDO::PARAM_INT);
            $stmp->bindParam(':estado', $descuentoCliente->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\DescuentoCliente $descuentoCliente) {
        try {
            $sql = 'UPDATE tb_descuento_cliente SET estado=:estado WHERE idDescuentoCliente = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $descuentoCliente->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $descuentoCliente->getIdMarca(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\DescuentoCliente $descuentoCliente) {
        $descuentoCliente->getDescuento();
        //no se usa nunca esta función
        return false;
    }

    public function listar() {
        $descuentosClientes = array();
        try {
            $sql = 'select dc.idDescuentoCliente, u.cedula, u.nombre, u.nombre, u.telefono,dc.descuento,dc.estado from tb_descuento_cliente dc, tb_usuario u where dc.idCliente = u.idUsuario';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $descuentosClientes[] = new Servicio($obj->idDescuentoCliente, $obj->cedula, $obj->nombre, $obj->telefono, $obj->descuento, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $descuentosClientes;
    }

    public function listarId($id) {
        $descuentoCliente = null;
        try {
            $sql = 'SELECT * from tb_descuento_cliente WHERE idDescuentoCliente = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $descuentoCliente = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $descuentoCliente;
    }

}
