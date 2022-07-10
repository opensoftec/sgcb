<?php

class daoTipoServicio implements Itiposervicio {

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

    public function crear(\TipoServicio $tiposervicio) {
        try {
            $sql = 'insert into tb_tiposervicio(descripcion,estado) values (:descripcion,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':descripcion', $tiposervicio->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $tiposervicio->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\TipoServicio $tiposervicio) {
        try {
            $sql = 'UPDATE tb_tiposervicio SET estado=:estado WHERE idTipoServicio = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $tiposervicio->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $tiposervicio->getIdTservicio(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\TipoServicio $tiposervicio) {
        try {
            $sql = 'UPDATE tb_tiposervicio SET descripcion=:descripcion, estado=:estado WHERE idTipoServicio = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $tiposervicio->getIdTservicio(), PDO::PARAM_INT);
            $stmp->bindParam(':descripcion', $tiposervicio->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $tiposervicio->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $tiposervicio = array();
        try {
            $sql = 'SELECT * from tb_tiposervicio';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $tiposervicio[] = new TipoServicio($obj->idTipoServicio, $obj->descripcion, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $tiposervicio;
    }

    public function listarId($idTipoServicio) {
        $tiposervicio = null;
        try {
            $sql = 'SELECT * from tb_tiposervicio WHERE idTipoServicio = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $idTipoServicio, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $tiposervicio = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $tiposervicio;
    }

}
