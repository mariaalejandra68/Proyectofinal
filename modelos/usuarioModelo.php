<?php

require_once "mainModel.php";

class usuarioModelo extends mainModel
{

    /*------------- MODELO AGREGAR USUARIO -----------------------*/
    protected static function agregar_usuario_modelos($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuarios(identificacion,nombre,dependencia,telefono,sede)       
        VALUES(:Identificacion,:Nombre,:Dependencia,:Telefono,:Sede)");
        $sql->bindParam(":Identificacion", $datos['Identificacion']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Dependencia", $datos['Dependencia']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Sede", $datos['Sede']);

        $sql->execute();
        return $sql;
    }

    protected static function agregar_admin_modelos($datos_admin){
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_administrador(useUser, usePass, tbl_usua_id, id_tipo_usu)       
        VALUES(:Nombre,:contrasena,:tbl_usua_id,:tipo)");
        $sql->bindParam(":Nombre", $datos_admin['Nombre']);
        $sql->bindParam(":contrasena", $datos_admin['contrasena']);
        $sql->bindParam(":tbl_usua_id", $datos_admin['tbl_usua_id']);
        $sql->bindParam(":tipo", $datos_admin['tipo']);
    
        $sql->execute();
        return $sql;
    }
    

    public function listar_tipo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_tipo");
        $sql->execute();
        return $sql;
    }
    

    /*------------- MODELO ELIMINAR USUARIO -----------------------*/
    protected static function eliminar_usuario_modelos($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_usuarios WHERE identificacion  =:Identificacion");

        $sql->bindParam(":Identificacion", $id);
        $sql->execute();

        return $sql;
    }

    /*------------- MODELO ACTUALIZAR USUARIO -----------------------*/
    protected static function datos_usuario_modelos($id){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_usuarios WHERE identificacion=:identificacion");

        $sql->bindParam(":identificacion",$id);
        $sql->execute();
        return $sql;
    }
    

    protected static function actualizar_usuario_modelos($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_usuarios SET nombre=:nombre, dependencia=:dependencia, telefono=:telefono, sede=:sede WHERE identificacion=:identificacion");
        $sql->bindParam(":identificacion", $datos['identificacion']);
        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":dependencia", $datos['dependencia']);
        $sql->bindParam(":telefono", $datos['telefono']);
        $sql->bindParam(":sede", $datos['sede']);
        
        $sql->execute();

        return $sql;
    }
    /*------------- FIN ACTUALIZAR USUARIO -----------------------------*/

}