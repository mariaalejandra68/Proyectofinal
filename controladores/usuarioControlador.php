<?php

if ($peticionAjax) {
    require_once "../modelos/usuarioModelo.php";
} else {
    require_once "./modelos/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{
    /*------------- CONTROLADOR AGREGAR USUARIO -----------------------*/
    public function agregar_usuario_controladores(){

        $identificacion = mainModel::limpiar_cadena($_POST['identificacion_reg']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre_reg']); 
        $dependencia = mainModel::limpiar_cadena($_POST['dependencia_reg']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono_reg']);
        $sede = mainModel::limpiar_cadena($_POST['sede_reg']);

        /* Verificando integridad de los datos */
        if ($identificacion == "" || $nombre == "" || $dependencia == "" || $telefono == ""  || $sede == "" ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{7,10}", $identificacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Identificación no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Primer nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $dependencia)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La dependencia no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT identificacion FROM tbl_usuarios WHERE identificacion='$identificacion'");
        if ($check_usuario->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "La identificación ingresada ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $datos_usuario_add  = [
            "Identificacion"=> $identificacion,
            "Nombre"=> $nombre,
            "Dependencia"=> $dependencia,
            "Telefono"=> $telefono,
            "Sede"=> $sede
        ];
        $agregar_usuario = usuarioModelo::agregar_usuario_modelos($datos_usuario_add);
        if ($agregar_usuario->rowCount() == 1) {
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
                "Texto" => "No hemos podido registrar el usuario.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }


    
    
    /*------------- FIN AGREGAR USUARIO -----------------------------*/
    
    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_usuario_controladores($pagina, $registros, $id, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $identificacion = mainModel::limpiar_cadena($id);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";
        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_usuarios WHERE ((identificacion!='$id'and identificacion!='1') AND (identificacion LIKE '%$busqueda%' OR nombre  LIKE '%$busqueda%')) ORDER BY identificacion ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_usuarios WHERE identificacion!='$id'and identificacion!='1' ORDER BY identificacion  ASC LIMIT $inicio, $registros";
        }

        $conexion = mainModel::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npaginas = ceil($total / $registros);

        $tabla .= '<div class="">
            <table class="table table-hover table-sm">
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">identificacion</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">dependencia</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">sede</th>
                <th class="text-center" colspan="2">Acciones</th>
            </tr>
            ';
        if ($total >= 1 &&  $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
               
                    $tabla .=
                        '<tr class="p">
                        <td class="min-width">' . $contador . '</td>
                        <td class="min-width">' . $rows['identificacion'] . '</td>
                        <td class="min-width">' . $rows['nombre'] . '</td>
                        <td class="min-width">' . $rows['dependencia'] . '</td>
                        <td class="min-width">' . $rows['telefono'] . '</td>
                        <td class="min-width">' . $rows['sede'] . '</td>
                          
                        <td class="stat"><a href="' . SERVERURL . 'actualizar-usuario/' . mainModel::encryption($rows['identificacion']) . '/"</input>
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-pencil-square lead"></i>
                            </button>
                        </td>  
                        <td>
                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/usuarioAjax.php" 
                                method="post" data-form="delete" autocomplete="off"> 		
                                <input type="hidden" name="usuario_eliminar" value="'  . mainModel::encryption($rows['identificacion']) . '"></input>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-trash3 lead"></i>
                                </button>
                            </form>
                        </td>
                    </tr>';
                
                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr style="border-bottom: 1px solid white;">
                                <td colspan="9"><a href="' . $url . '"><i class="bi bi-arrow-left-square"></i>
                                Haga click aquí para cargar nuevamente la lista <i class="bi bi-arrow-right-square"></i></a></td></tr>';
            } else {
                $tabla .= '<tr style="border-bottom: 1px solid white;">
                                <td colspan="9">No hay registros en el Sistema</td></tr>';
            }
            
        }
        
        $tabla .= '</table> </div>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-end text-muted mt-5"> Lista de Personas' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 3);
        }

        return $tabla;

    }/*------------------- FIN TABLA ---------------------------------*/

    /*------------- CONTROLADOR ELIMINAR USUARIO --------------------*/
    public function eliminar_usuario_controladores()
    {
        $id = mainModel::decryption($_POST['usuario_eliminar']);
        $id = mainModel::limpiar_cadena($id);
    
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT identificacion  FROM tbl_usuarios WHERE identificacion  ='$id'");
        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El usuario que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $eliminar_usuario = usuarioModelo::eliminar_usuario_modelos($id);
    
        if ($eliminar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Eliminado",
                "Texto" => "Se ha eliminado el usuario exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos podido eliminar la persona.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    
   /*-------------- FIN ELIMINAR USUARIO --------------------------*/

   /*------------- CONTROLADOR ACTUALIZAR USUARIO -----------------------*/
   public function datos_usuario_controladores($id){
    $id=mainModel::decryption($id);
    return usuarioModelo::datos_usuario_modelos($id);
}

public function actualizar_usuario_controladores()
{
    $id = mainModel::decryption($_POST['identificacion_up']);
    $id = mainModel::limpiar_cadena($id);
    $id = $_POST['identificacion_up'];

    $check_reg = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_usuarios WHERE identificacion='$id'");
    if ($check_reg->rowCount() <= 0) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado.",
            "Texto" => "No hemos encontrado la persona en el sistema",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    } else {
        $campos = $check_reg->fetch();
    }
    
    $id = mainModel::limpiar_cadena($_POST['identificacion_up']);
    $nombre = mainModel::limpiar_cadena($_POST['nombre_up']);
    $dependencia = mainModel::limpiar_cadena($_POST['dependencia_up']);
    $telefono = mainModel::limpiar_cadena($_POST['telefono_up']);
    $sede = mainModel::limpiar_cadena($_POST['sede_up']);

    /* Verificando integridad de los datos */
    if ($id == "" || $nombre == "" || $dependencia == "" || $telefono == ""  || $sede == "" ) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No has llenado todos los campos que son obligatorios",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }
    if (mainModel::verificar_datos("[0-9]{2,10}", $id)) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "El Identificación no coincide con el formato solicitado",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }
    if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $nombre)) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "El Primer nombre no coincide con el formato solicitado",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }

    if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $dependencia)) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "La dependencia no coincide con el formato solicitado",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }
    if ($id != $campos['identificacion']) {
        $check_reg = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_usuarios WHERE identificacion='$id'");
        if ($check_reg->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "La Identificacion ingresada ya se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    }
    $datos_reg_up = [
        "identificacion"   => $id,
        "nombre"           => $nombre,
        "dependencia"      => $dependencia,
        "telefono"         => $telefono,
        "sede"             => $sede,
        
    ];
    if (usuarioModelo::actualizar_usuario_modelos($datos_reg_up)) {
        $alerta = [
            "Alerta" => "recargar",
            "Titulo" => "Datos actualizados",
            "Texto" => "Los datos han sido actualizados exitosamente",
            "Tipo" => "success"
        ];
    } else {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No hemos podido actualizar tus datos ;(",
            "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
    exit();
}

}
    /*------------------ FIN ACTUALIZAR  -----------------------*/


