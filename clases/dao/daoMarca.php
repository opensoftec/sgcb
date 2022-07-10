<?php

class daoMarca implements Imarca {

    public function crear(\Marca $marca) {
        try {
            $sql = 'insert into tb_marca (descripcion,estado) values (:descripcion,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':descripcion', $marca->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $marca->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\Marca $marca) {
        try {
            $sql = 'UPDATE tb_marca SET estado=:estado WHERE idMarca = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $marca->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $marca->getIdMarca(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\Marca $marca) {
        try {
            $sql = 'UPDATE tb_marca SET descripcion=:descripcion, estado=:estado WHERE idMarca = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $marca->getIdMarca(), PDO::PARAM_INT);
            $stmp->bindParam(':descripcion', $marca->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $marca->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $marcas = array();
        try {
            $sql = 'SELECT * from tb_marca';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $marcas[] = new Marca($obj->idMarca, $obj->descripcion, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $marcas;
    }

    public function listarId($idMarca) {
        $marca = null;
        try {
            $sql = 'SELECT * from tb_marca WHERE idMarca = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $idMarca, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $marca = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $marca;
    }

}
