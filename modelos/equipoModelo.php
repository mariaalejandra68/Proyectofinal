<?php

require_once "mainModel.php";

class equipoModelo extends mainModel
{

    /*------------- MODELO AGREGAR EQUIPO -----------------------*/
    protected static function agregar_equipo_modelos($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_equipos(n_placa,n_serial,descripcion,id_disponibilidad)      
        VALUES(:n_placa,:n_serial,:descripcion,:id_disponibilidad)");
        $sql->bindParam(":n_placa", $datos['n_placa']);
        $sql->bindParam(":n_serial", $datos['n_serial']);
        $sql->bindParam(":descripcion", $datos['descripcion']);
        $sql->bindParam(":id_disponibilidad", $datos['id_disponibilidad']);

        $sql->execute();
        return $sql;
    }
    public function listar_usuario()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_usuarios");
        $sql->execute();
        return $sql;
    }

    public function listar_disponibilidad()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_disponibilidad");
        $sql->execute();
        return $sql;
    }

   
    /*------------- MODELO ELIMINAR EQUIPO -----------------------*/
    protected static function eliminar_equipo_modelos($n_placa)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_equipos WHERE n_placa  =:n_placa");

        $sql->bindParam(":n_placa", $n_placa);
        $sql->execute();

        return $sql;
    }

    /*------------- MODELO ACTUALIZAR EQUIPO -----------------------*/
    protected static function datos_equipo_modelos($n_placa){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_equipos WHERE n_placa=:n_placa");

        $sql->bindParam(":n_placa",$n_placa);
        $sql->execute();
        return $sql;
    }
    

    protected static function actualizar_equipo_modelos($datos2)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_equipos SET n_serial=:n_serial, descripcion=:descripcion, id_disponibilidad=:id_disponibilidad, id_usuario=:id_usuario WHERE n_placa=:n_placa");
        $sql->bindParam(":n_placa", $datos2['n_placa']);
        $sql->bindParam(":n_serial", $datos2['n_serial']);
        $sql->bindParam(":descripcion", $datos2['descripcion']);
        $sql->bindParam(":id_disponibilidad", $datos2['id_disponibilidad']);
        $sql->bindParam(":id_usuario", $datos2['id_usuario']);
        $sql->execute();

        return $sql;
    }
    /*------------- FIN ACTUALIZAR EQUIPO -----------------------------*/

}