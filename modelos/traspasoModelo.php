<?php

require_once "mainModel.php";

class traspasoModelo extends mainModel
{

    /*------------- MODELO AGREGAR TRASPASO -----------------------*/
    protected static function agregar_traspaso_modelos($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_traspaso(fecha_traspaso,id_usuario_entrega,id_usuario_recibe,id_equipo)      
        VALUES(NOW(),:id_usuario_entrega,:id_usuario_recibe,:id_equipo)");
        $sql->bindParam(":id_usuario_entrega", $datos['id_usuario_entrega']);
        $sql->bindParam(":id_usuario_recibe", $datos['id_usuario_recibe']);
        $sql->bindParam(":id_equipo", $datos['id_equipo']);

        $sql->execute();
        return $sql;
    }
    public function listar_usuario()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_usuarios");
        $sql->execute();
        return $sql;
    }

    public function listar_equipos_por_usuario($usuarioSeleccionado) {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_equipos WHERE id_usuario = :usuario");
        $sql->bindParam(":usuario", $usuarioSeleccionado);
        $sql->execute();
        return $sql;
    }
    
    public function listar_equipos()
    {
        if (!isset($usuarioEntrega)){
            $usuarioEntrega = 0;
        }
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_equipos");
        $sql->execute();
        return $sql;
    }

   
    /*------------- MODELO ELIMINAR EQUIPO -----------------------*/
    protected static function eliminar_traspaso_modelos($id_traspaso)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM tbl_traspaso WHERE id_traspaso=:id_traspaso");

        $sql->bindParam(":id_traspaso", $id_traspaso);
        $sql->execute();

        return $sql;
    }

    /*------------- MODELO ACTUALIZAR EQUIPO -----------------------*/
    protected static function datos_traspaso_modelos($n_placa){
        $sql=mainModel::conectar()->prepare("SELECT * FROM tbl_traspaso WHERE id_traspaso=:id_traspaso");

        $sql->bindParam(":id_traspaso",$id_traspaso);
        $sql->execute();
        return $sql;
    }
    

    protected static function actualizar_traspaso_modelos($datos2)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_traspaso SET fecha_traspaso=:fecha_traspaso, id_usuario_entrega=:id_usuario_entrega, id_usuario_recibe=:id_usuario_recibe, id_equipo=:id_equipo WHERE id_traspaso=:id_traspaso");
        $sql->bindParam(":id_traspaso", $datos2['id_traspaso']);
        $sql->bindParam(":fecha_traspaso", $datos2['fecha_traspaso']);
        $sql->bindParam(":id_usuario_entrega", $datos2['id_usuario_entrega']);
        $sql->bindParam(":id_usuario_recibe", $datos2['id_usuario_recibe']);
        $sql->bindParam(":id_equipo", $datos2['id_equipo']);
        $sql->execute();

        return $sql;
    }
    /*------------- FIN ACTUALIZAR EQUIPO -----------------------------*/

}