<?php

require_once "mainModel.php";

class devolucionesModelo extends mainModel
{

    /*------------- MODELO AGREGAR EQUIPO -----------------------*/
    protected static function agregar_devoluciones_modelos($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_devoluciones(id_devolucion,fecha_devolucion,id_usuario,id_equipo,id_soporte,observaciones)      
        VALUES(:id_devolucion,:fecha_devolucion,:id_usuario,:id_equipo,:id_soporte,:observaciones)");
        $sql->bindParam(":id_devolucion", $datos['id_devolucion']);
        $sql->bindParam(":fecha_devolucion", $datos['fecha_devolucion']);
        $sql->bindParam(":id_usuario", $datos['id_usuario']);
        $sql->bindParam(":id_equipo", $datos['id_equipo']);
        $sql->bindParam(":id_soporte", $datos['id_soporte']);
        $sql->bindParam(":observaciones", $datos['observaciones']);

        $sql->execute();
        return $sql;
    }
    public function listar_usuario()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_usuarios");
        $sql->execute();
        return $sql;
    }

    public function listar_equipos()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_equipos");
        $sql->execute();
        return $sql;
    }
    
    
    public function listar_soporte()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_soporte_tecnico");
        $sql->execute();
        return $sql;
    }

   
    /*------------- MODELO ELIMINAR EQUIPO -----------------------*/
    protected static function eliminar_devoluciones_modelos($id_devolucion)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_devoluciones WHERE id_devolucion  =:id_devolucion");

        $sql->bindParam(":id_devolucion ", $id_devolucion );
        $sql->execute();

        return $sql;
    }

    /*------------- MODELO ACTUALIZAR EQUIPO -----------------------*/
    protected static function datos_devoluciones_modelos($id_devolucion){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_devoluciones WHERE id_devolucion=:id_devolucion");

        $sql->bindParam(":id_devolucion",$id_devolucion);
        $sql->execute();
        return $sql;
    }
    

    protected static function actualizar_devoluciones_modelos($datos2)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_devoluciones SET fecha_devolucion=:fecha_devolucion, id_usuario=:id_usuario, id_equipo=:id_equipo, id_soporte=:id_soporte, observaciones=:observaciones WHERE id_devolucion=:id_devolucion");
        $sql->bindParam(":id_devolucion", $datos2['id_devolucion']);
        $sql->bindParam(":fecha_devolucion", $datos2['fecha_devolucion']);
        $sql->bindParam(":id_usuario", $datos2['id_usuario']);
        $sql->bindParam(":id_equipo", $datos2['id_equipo']);
        $sql->bindParam(":id_soporte", $datos2['id_soporte']);
        $sql->bindParam(":observaciones", $datos2['observaciones']);
        $sql->execute();

        return $sql;
    }
    /*------------- FIN ACTUALIZAR EQUIPO -----------------------------*/

}