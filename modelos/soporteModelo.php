<?php

require_once "mainModel.php";

class soporteModelo extends mainModel
{

    /*------------- MODELO AGREGAR USUARIO -----------------------*/
    protected static function agregar_soporte_modelos($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_soporte_tecnico(identificacion,nombre)       
        VALUES(:identificacion,:nombre)");
        $sql->bindParam(":identificacion", $datos['identificacion']);
        $sql->bindParam(":nombre", $datos['nombre']);

        $sql->execute();
        return $sql;
    }

}