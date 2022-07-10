<?php

class daoReporte {

    public function lista($year) {
        $data = array();
        try {
            $sql = 'select COUNT(MONTH(fechaIngreso)) as cant, MONTHNAME(fechaIngreso) as mes from tb_orden_ingreso where YEAR(fechaIngreso) = :year group by (MONTH(fechaIngreso)) order by MONTH(fechaIngreso)';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':year', $year, PDO::PARAM_INT);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $data[] = array($obj->cant, $obj->mes);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $data;
    }

public function total($inicio,$fin){
        $data = array();
        try {
            $sql = 'select COUNT(idOrdenIngreso) as cant, estado from tb_orden_ingreso where fechaEntrega BETWEEN :inicio and :fin group by estado order by estado';
            $cn = DataBase::getInstancia();
            $stmp = $cn->prepare($sql);
            $stmp->bindParam(':inicio', $inicio, PDO::PARAM_STR);
            $stmp->bindParam(':fin', $fin, PDO::PARAM_STR);
            $stmp->execute();
            foreach ($stmp->fetchAll(PDO::FETCH_OBJ) as $obj) {
                $data[] = array($obj->cant, $obj->estado);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $data;
    }
}
