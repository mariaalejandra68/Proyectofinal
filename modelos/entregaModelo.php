<?php

require_once "mainModel.php";

class entregaModelo extends mainModel
{

    /*------------- MODELO AGREGAR USUARIO -----------------------*/
    protected static function agregar_entrega_modelos($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_entrega(id_entrega,fecha_entrega,ciudad_entrega,codigo_tic_sena,codigo_sitio,nombre_representante,documento_representante,id_usuario,id_equipo)       
        VALUES(:id_entrega,:fecha_entrega,:ciudad_entrega,:codigo_tic_sena,:codigo_sitio,:nombre_representante,:documento_representante,:id_usuario,:id_equipo)");
        $sql->bindParam(":id_entrega", $datos['id_entrega']);
        $sql->bindParam(":fecha_entrega", $datos['fecha_entrega']);
        $sql->bindParam(":ciudad_entrega", $datos['ciudad_entrega']);
        $sql->bindParam(":codigo_tic_sena", $datos['codigo_tic_sena']);
        $sql->bindParam(":codigo_sitio", $datos['codigo_sitio']);
        $sql->bindParam(":nombre_representante", $datos['nombre_representante']);
        $sql->bindParam(":documento_representante", $datos['documento_representante']);
        $sql->bindParam(":id_usuario", $datos['id_usuario']);
        $sql->bindParam(":id_equipo", $datos['id_equipo']);

        $sql->execute();
        return $sql;
    }

    public function listar_equipos()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_equipos");
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
        protected static function eliminar_entrega_modelos($id_entrega)
        {
            $sql = mainModel::conectar()->prepare("DELETE FROM tbl_entrega WHERE id_entrega=:id_entrega");
    
            $sql->bindParam(":id_entrega", $id_entrega);
            $sql->execute();
    
            return $sql;
        }
    
        /*------------- MODELO ACTUALIZAR EQUIPO -----------------------*/
        protected static function datos_entrega_modelos($id_entrega){
            $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_entrega WHERE id_entrega =:id_entrega");
    
            $sql->bindParam(":id_entrega",$id_entrega);
            $sql->execute();
            return $sql;
        }
        
    
        protected static function actualizar_entrega_modelos($datos)
        {
            $sql = mainModel::conectar()->prepare("UPDATE tbl_entrega SET fecha_entrega=:fecha_entrega, ciudad_entrega=:ciudad_entrega, codigo_tic_sena=:codigo_tic_sena, codigo_sitio=:codigo_sitio, nombre_representante=:nombre_representante, documento_representante=:documento_representante, id_usuario=:id_usuario, id_equipo=:id_equipo WHERE id_entrega=:id_entrega");
            $sql->bindParam(":id_entrega", $datos['id_entrega']);
            $sql->bindParam(":fecha_entrega", $datos['fecha_entrega']);
            $sql->bindParam(":ciudad_entrega", $datos['ciudad_entrega']);
            $sql->bindParam(":codigo_tic_sena", $datos['codigo_tic_sena']);
            $sql->bindParam(":codigo_sitio", $datos['codigo_sitio']);
            $sql->bindParam(":nombre_representante", $datos['nombre_representante']);
            $sql->bindParam(":documento_representante", $datos['documento_representante']);
            $sql->bindParam(":id_usuario", $datos['id_usuario']);
            $sql->bindParam(":id_equipo", $datos['id_equipo']);
            $sql->execute();
    
            return $sql;
        }
        /*------------- FIN ACTUALIZAR EQUIPO -----------------------------*/
    
    
}