<?php

class daoProveedor implements Iproveedor {

    public function Codigo() {
        $codigo = "";
        try {
            $sql = 'SELECT IFNULL(MAX(id)+1,1) codigo from tbempleado';
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

    public function crear(\Proveedor $proveedor) {
        try {
            $sql = 'insert into tb_proveedor(nombre,sucursal,direccion,telefono,responsable,estado) values (:nombre,:sucursal,:direccion,:telefono,:responsable,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':nombre', $proveedor->getNombre(), PDO::PARAM_STR);
            $stmp->bindParam(':sucursal', $proveedor->getSucursal(), PDO::PARAM_STR);
            $stmp->bindParam(':direccion', $proveedor->getDireccion(), PDO::PARAM_STR);
            $stmp->bindParam(':telefono', $proveedor->getTelefono(), PDO::PARAM_STR);
            $stmp->bindParam(':responsable', $proveedor->getResponsable(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $proveedor->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\Proveedor $proveedor) {
        try {
            $sql = 'UPDATE tb_proveedor SET estado=:estado WHERE idProveedor = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $proveedor->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $proveedor->getIdProveedor(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\Proveedor $proveedor) {
        try {
            $sql = 'UPDATE tb_proveedor SET nombre=:nombre, sucursal=:sucursal, direccion=:direccion, telefono=:telefono, responsable=:responsable, estado=:estado WHERE idProveedor = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $proveedor->getIdProveedor(), PDO::PARAM_INT);
            $stmp->bindParam(':nombre', $proveedor->getNombre(), PDO::PARAM_STR);
            $stmp->bindParam(':sucursal', $proveedor->getSucursal(), PDO::PARAM_STR);
            $stmp->bindParam(':direccion', $proveedor->getDireccion(), PDO::PARAM_STR);
            $stmp->bindParam(':telefono', $proveedor->getTelefono(), PDO::PARAM_STR);
            $stmp->bindParam(':responsable', $proveedor->getResponsable(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $proveedor->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $proveedores = array();
        try {
            $sql = 'SELECT * from tb_proveedor';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $proveedores[] = new Proveedor($obj->idProveedor, $obj->nombre, $obj->sucursal, $obj->direccion, $obj->telefono, $obj->responsable, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $proveedores;
    }

    public function listarId($id) {
        $proveedor = null;
        try {
            $sql = 'SELECT * from tb_proveedor WHERE idProveedor = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $proveedor = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $proveedor;
    }

}
