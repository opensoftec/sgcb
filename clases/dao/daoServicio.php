<?php

class daoServicio implements Iservicio {

    public function crear(\Servicio $servicio) {
        try {
            $sql = 'insert into tb_servicio (descripcion,precio,idTipoServicio,observacion,estado) values (:descripcion,:precio,:idtipo,:observacion,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':descripcion', $servicio->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':precio', $servicio->getPrecio(), PDO::PARAM_INT);
            $stmp->bindParam(':idtipo', $servicio->getIdTipoServicio(), PDO::PARAM_INT);
            $stmp->bindParam(':observacion', $servicio->getObservacion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $servicio->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\Servicio $servicio) {
        try {
            $sql = 'UPDATE tb_servicio SET estado=:estado WHERE idServicio = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $servicio->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $servicio->getIdServicio(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\Servicio $servicio) {
        try {
            $sql = 'UPDATE tb_servicio SET descripcion=:descripcion,precio=:precio,idTipoServicio=:idtipo,observacion=:observacion, estado=:estado WHERE idServicio = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $servicio->getIdServicio(), PDO::PARAM_INT);
            $stmp->bindParam(':descripcion', $servicio->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':precio', $servicio->getPrecio(), PDO::PARAM_INT);
            $stmp->bindParam(':idtipo', $servicio->getIdTipoServicio(), PDO::PARAM_INT);
            $stmp->bindParam(':observacion', $servicio->getObservacion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $servicio->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $servicios = array();
        try {
            $sql = 'select s.idServicio, s.descripcion, s.precio, t.descripcion descripcionServicio, s.observacion, s.estado from tb_servicio s , tb_tiposervicio t where t.idTipoServicio = s.idTipoServicio';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $servicios[] = new Servicio($obj->idServicio, $obj->descripcion, $obj->precio, $obj->descripcionServicio, $obj->observacion, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $servicios;
    }

    public function listarId($idServicio) {
        $servicio = null;
        try {
            $sql = 'SELECT * from tb_servicio WHERE idServicio = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $idServicio, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $servicio = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $servicio;
    }

}
