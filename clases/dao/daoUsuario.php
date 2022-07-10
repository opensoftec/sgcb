<?php

class daoUsuario implements Iusuario {

    public function crear(\Usuario $usuario) {
        try {
            $sql = 'insert into tb_usuario (cedula,nombre,apellido,direccion,telefono,correo,usuario,contrasena,idTipoUsuario,estado) values (:cedula,:nombre,:apellido,:direccion,:telefono,:correo,:usuario,:contrasena,:idtipo,:estado)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':cedula', $usuario->getCedula(), PDO::PARAM_STR);
            $stmp->bindParam(':nombre', $usuario->getNombre(), PDO::PARAM_STR);
            $stmp->bindParam(':apellido', $usuario->getApellido(), PDO::PARAM_STR);
            $stmp->bindParam(':direccion', $usuario->getDireccion(), PDO::PARAM_STR);
            $stmp->bindParam(':telefono', $usuario->getTelefono(), PDO::PARAM_STR);
            $stmp->bindParam(':correo', $usuario->getCorreo(), PDO::PARAM_STR);
            $stmp->bindParam(':usuario', $usuario->getUsuario(), PDO::PARAM_STR);
            $stmp->bindParam(':contrasena', $usuario->getClave(), PDO::PARAM_STR);
            $stmp->bindParam(':idtipo', $usuario->getIdTipoUsuario(), PDO::PARAM_INT);
            $stmp->bindParam(':estado', $usuario->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function delete(\Usuario $usuario) {
        try {
            $sql = 'UPDATE tb_usuario SET estado=:estado WHERE idUsuario = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':estado', $usuario->getEstado(), PDO::PARAM_INT);
            $stmp->bindParam(':id', $usuario->getIdUsuario(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() > 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function editar(\Usuario $usuario) {
        try {
            $sql = 'UPDATE tb_usuario SET cedula=:cedula, nombre=:nombre, apellido=:apellido, direccion=:direccion, telefono=:telefono, correo=:correo, usuario=:usuario, contrasena=:contrasena, idTipoUsuario=:idtipo, estado=:estado WHERE idUsuario = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $usuario->getIdUsuario(), PDO::PARAM_INT);
            $stmp->bindParam(':cedula', $usuario->getCedula(), PDO::PARAM_STR);
            $stmp->bindParam(':nombre', $usuario->getNombre(), PDO::PARAM_STR);
            $stmp->bindParam(':apellido', $usuario->getApellido(), PDO::PARAM_STR);
            $stmp->bindParam(':direccion', $usuario->getDireccion(), PDO::PARAM_STR);
            $stmp->bindParam(':telefono', $usuario->getTelefono(), PDO::PARAM_STR);
            $stmp->bindParam(':correo', $usuario->getCorreo(), PDO::PARAM_STR);
            $stmp->bindParam(':usuario', $usuario->getUsuario(), PDO::PARAM_STR);
            $stmp->bindParam(':contrasena', $usuario->getClave(), PDO::PARAM_STR);
            $stmp->bindParam(':idtipo', $usuario->getIdTipoUsuario(), PDO::PARAM_INT);
            $stmp->bindParam(':estado', $usuario->getEstado(), PDO::PARAM_INT);
            $stmp->execute();
            return $stmp->rowCount() >= 0 ? true : false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public function listar() {
        $usuarios = array();
        try {
            $sql = 'select u.idUsuario,u.cedula,u.nombre,u.apellido,u.direccion,u.telefono,u.correo,u.usuario,t.descripcion idTipoUsuario,u.estado from tb_usuario u,tb_tipousuario t where u.idTipoUsuario=t.idTipoUsuario';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $usuarios[] = new Usuario($obj->idUsuario, $obj->cedula, $obj->nombre, $obj->apellido, $obj->direccion, $obj->telefono, $obj->correo, $obj->usuario, "", $obj->idTipoUsuario, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $usuarios;
    }

    public function listarCliente() {
        $usuarios = array();
        try {
            $sql = 'select u.idUsuario,u.cedula,u.nombre,u.apellido,u.direccion,u.telefono,u.correo,u.usuario,t.descripcion idTipoUsuario,u.estado from tb_usuario u,tb_tipousuario t where u.idTipoUsuario = t.idTipoUsuario and u.idTipoUsuario=4';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $usuarios[] = new Usuario($obj->idUsuario, $obj->cedula, $obj->nombre, $obj->apellido, $obj->direccion, $obj->telefono, $obj->correo, $obj->usuario, "", $obj->idTipoUsuario, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $usuarios;
    }

    public function listarTecnico() {
        $usuarios = array();
        try {
            $sql = 'select u.idUsuario,u.cedula,u.nombre,u.apellido,u.direccion,u.telefono,u.correo,u.usuario,t.descripcion idTipoUsuario,u.estado from tb_usuario u,tb_tipousuario t where u.idTipoUsuario = t.idTipoUsuario and u.idTipoUsuario=3';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $usuarios[] = new Usuario($obj->idUsuario, $obj->cedula, $obj->nombre, $obj->apellido, $obj->direccion, $obj->telefono, $obj->correo, $obj->usuario, "", $obj->idTipoUsuario, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $usuarios;
    }

    public function listarTecnicoAdministrador() {
        $usuarios = array();
        try {
            $sql = 'select u.idUsuario,u.cedula,u.nombre,u.apellido,u.direccion,u.telefono,u.correo,u.usuario,t.descripcion idTipoUsuario,u.estado from tb_usuario u,tb_tipousuario t where u.idTipoUsuario = t.idTipoUsuario and u.idTipoUsuario=5';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $usuarios[] = new Usuario($obj->idUsuario, $obj->cedula, $obj->nombre, $obj->apellido, $obj->direccion, $obj->telefono, $obj->correo, $obj->usuario, "", $obj->idTipoUsuario, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $usuarios;
    }

    public function listarId($id) {
        $usuario = array();
        try {
            $sql = 'select u.idUsuario,u.cedula,u.nombre,u.apellido,u.direccion,u.telefono,u.correo,u.usuario,u.contrasena,t.descripcion idTipoUsuario,u.estado from tb_usuario u,tb_tipousuario t where u.idTipoUsuario=t.idTipoUsuario and idUsuario = :id';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':id', $id, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $u) {
                $usuario = $u;
            }
            return $usuario;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $usuario;
    }

    public function login(\Usuario $usuario) {
        $usuario_obj = array();
        try {
            $sql = "select * from tb_usuario where usuario = :user and contrasena = :password and estado=1";
            //Abro la conexion a la BD
            $con = DataBase::getInstancia();
            //prepara el Query SQL
            $stmp = $con->prepare($sql);
            $stmp->bindParam(':user', $usuario->getUsuario(), 5);
            $stmp->bindParam(':password', $usuario->getClave(), 5);
            //Ejecuto el Query SQL
            $stmp->execute();
            if (($u = $stmp->fetch(PDO::FETCH_OBJ))) {
                $usuario_obj = $u;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $usuario_obj;
    }
    //nuevo
    public function idCliente($cedula) {
        $id = '';
        try {
            $sql = 'select u.cedula from tb_usuario u where u.cedula = :cedula';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':cedula', $cedula, PDO::PARAM_STR);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $id = $obj->cedula;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $id;
    }
    //finnuevo
}
