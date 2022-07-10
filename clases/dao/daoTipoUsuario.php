<?php

class daoTipoUsuario implements Itipousuario {

    public function crear(\TipoUsuario $tipousuario) {
        try {
            $sql = 'insert into tb_tipousuario (descripcion,estado) values (:descripcion,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':descripcion', $tipousuario->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $tipousuario->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\TipoUsuario $tipousuario) {
        try {
            $sql = 'UPDATE tb_tipousuario SET estado=:estado WHERE idTipoUsuario = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $tipousuario->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $tipousuario->getIdTipoUsuario(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\TipoUsuario $tipousuario) {
        try {
            $sql = 'UPDATE tb_tipousuario SET descripcion=:descripcion, estado=:estado WHERE idTipoUsuario = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $tipousuario->getIdTipoUsuario(), PDO::PARAM_INT);
            $stmp->bindParam(':descripcion', $tipousuario->getDescripcion(), PDO::PARAM_STR);
            $stmp->bindParam(':estado', $tipousuario->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $tiposusuarios = array();
        try {
            $sql = 'SELECT * from tb_tipousuario';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $tiposusuarios[] = new TipoUsuario($obj->idTipoUsuario, $obj->descripcion, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $tiposusuarios;
    }

    public function listarId($id) {
        $tipousuario = null;
        try {
            $sql = 'SELECT * from tb_tipousuario WHERE idTipoUsuario = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $tipousuario = $obj;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $tipousuario;
    }

}
