<?php

class daoDepartamentoProveedor implements Idepartamentoproveedor {

    public function crear(\DepartamentoProveedor $departamentoProveedor) {
        try {
            $sql = 'insert into tb_departamento_proveedor (descripcion,responsable,telefono,idProveedor,estado) '
                    . 'values (:descripcion,:responsable,:telefono,:idproveedor,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':descripcion', $departamentoProveedor->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':responsable', $departamentoProveedor->getResponsable(), PDO::PARAM_STR);
            $stmp->bindParam(':telefono', $departamentoProveedor->getTelefono(), PDO::PARAM_STR);
            $stmp->bindParam(':idproveedor', $departamentoProveedor->getIdProveedor(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $departamentoProveedor->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\DepartamentoProveedor $departamentoProveedor) {
        try {
            $sql = 'UPDATE tb_departamento_proveedor SET estado=:estado WHERE idDepartamentoProveedor = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $departamentoProveedor->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $departamentoProveedor->getIdDepartamentoProveedor(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\DepartamentoProveedor $departamentoProveedor) {
        try {
            $sql = 'UPDATE tb_departamento_proveedor SET descripcion=:descripcion,responsable=:responsable,telefono=:telefono,idProveedor=:idproveedor,estado=:estado WHERE idDepartamentoProveedor = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $departamentoProveedor->getIdDepartamentoProveedor(), PDO::PARAM_INT);
            $stmp->bindParam(':descripcion', $departamentoProveedor->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':responsable', $departamentoProveedor->getResponsable(), PDO::PARAM_STR);
            $stmp->bindParam(':telefono', $departamentoProveedor->getTelefono(), PDO::PARAM_STR);
            $stmp->bindParam(':idproveedor', $departamentoProveedor->getIdProveedor(), PDO::PARAM_INT);
            $stmp->bindParam(':estado', $departamentoProveedor->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $departamentoProveedores = array();
        try {
            $sql = 'select dp.idDepartamentoProveedor, dp.descripcion, dp.responsable, dp.telefono, p.nombre, p.sucursal, dp.estado from tb_departamento_proveedor dp, tb_proveedor p where dp.idProveedor = p.idProveedor';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $departamentoProveedores[] = new DepartamentoProveedor($obj->idDepartamentoProveedor, $obj->descripcion, $obj->responsable, $obj->telefono, $obj->nombre, $obj->estado, $obj->sucursal);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $departamentoProveedores;
    }

    public function listarId($idDepartamentoProveedor) {
        $departamentoProveedor = null;
        try {
            $sql = 'SELECT * from tb_departamento_proveedor WHERE idDepartamentoProveedor = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $idDepartamentoProveedor, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $departamentoProveedor = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $departamentoProveedor;
    }

}
