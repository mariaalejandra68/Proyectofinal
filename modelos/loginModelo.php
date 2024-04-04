<?php 
require_once "mainModel.php";

class loginModelo extends mainModel{   

    /*----------- modelo para iniciar sesion ------------------*/
    protected static function iniciar_sesion_modelos($datos){
        $correo = $datos['correo'];
        $contrasena = $datos['Contra'];

        $sql=mainModel::conectar()->prepare("SELECT  id_tipo_usu, tbl_usua_id, usePass FROM tbl_administrador JOIN tbl_usuarios ON tbl_usuarios.identificacion = tbl_administrador.tbl_usua_id 
        WHERE tbl_administrador.tbl_usua_id = :correo AND tbl_administrador.usePass = :Contra");
        $sql->bindParam(":correo", $correo);
        $sql->bindParam(":Contra", $contrasena);

        $sql->execute();

        return $sql;
    }
}