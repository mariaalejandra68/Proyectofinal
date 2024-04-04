<?php

if ($peticionAjax) {
    require_once "../modelos/soporteModelo.php";
} else {
    require_once "./modelos/soporteModelo.php";
}

class soporteControlador extends soporteModelo
{
    /*------------- CONTROLADOR AGREGAR EQUIPO -----------------------*/
    public function agregar_soporte_controladores(){

        $identificacion = mainModel::limpiar_cadena($_POST['identificacion_reg']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre_reg']);
        


        /* Verificando integridad de los datos */
        if (empty($identificacion) || empty($nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{4,10}", $identificacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El numero de identificacion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $check_soporte = mainModel::ejecutar_consulta_simple("SELECT identificacion FROM tbl_soporte_tecnico WHERE identificacion='$identificacion'");
        if ($check_soporte->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "la identificacion ingresada ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $datos_soporte_add  = [
            "identificacion"=> $identificacion,
            "nombre"=> $nombre
        ];
        $agregar_soporte = soporteModelo::agregar_soporte_modelos($datos_soporte_add);
        if ($agregar_soporte->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Usuario Registrado",
                "Texto" => "El usuario ha sido registrado exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido registrar el equipo.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }
}
    


