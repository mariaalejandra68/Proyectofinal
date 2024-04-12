<?php

if ($peticionAjax) {
    require_once "../modelos/devolucionesModelo.php";
} else {
    require_once "./modelos/devolucionesModelo.php";
}

class devolucionesControlador extends devolucionesModelo
{
    /*------------- CONTROLADOR AGREGAR USUARIO -----------------------*/
    public function agregar_devoluciones_controladores(){

        $id_devolucion = mainModel::limpiar_cadena($_POST['id_devolucion_reg']);
        $fecha_devolucion = mainModel::limpiar_cadena($_POST['fecha_devolucion_reg']); 
        $id_usuario = mainModel::limpiar_cadena($_POST['id_usuario_reg']);
        $id_equipo = mainModel::limpiar_cadena($_POST['id_equipo_reg']);
        $id_soporte = mainModel::limpiar_cadena($_POST['id_soporte_reg']);
        $observaciones= mainModel::limpiar_cadena($_POST['observaciones_reg']);

        /* Verificando integridad de los datos */
        if ($id_devolucion == "" || $fecha_devolucion == "" || $id_usuario == "" || $id_equipo == ""  || $id_soporte == "" || $observaciones == "" ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{4,10}", $id_devolucion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Identificación no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        

        if (mainModel::verificar_datos("[0-9]{4,10}", $id_usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "el ID no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{4,10}", $id_equipo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "el ID no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $observaciones)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La observaciones no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
         $check_devoluciones = mainModel::ejecutar_consulta_simple("SELECT id_devolucion FROM tbl_devoluciones WHERE id_devolucion='$id_devolucion'");
        if ($check_devoluciones->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "La identificación ingresada ya se encuentra registrada en el sistema",
                "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }
        $datos_devoluciones_add  = [
            "id_devolucion"=> $id_devolucion,
            "fecha_devolucion"=> $fecha_devolucion,
            "id_usuario"=> $id_usuario,
            "id_equipo"=> $id_equipo,
            "id_soporte"=> $id_soporte,
            "observaciones"=> $observaciones
        ];
        $agregar_devoluciones = devolucionesModelo::agregar_devoluciones_modelos($datos_devoluciones_add);
        if ($agregar_devoluciones->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Devolución Registrada",
                "Texto" => "la devolucion ha sido registrada exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido registrar la devolucion.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }


    
    
    /*------------- FIN AGREGAR USUARIO -----------------------------*/
    
    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_devoluciones_controladores($pagina, $registros, $id_devolucion, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $id_devolucion = mainModel::limpiar_cadena($id_devolucion);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";
        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_devoluciones WHERE ((id_devolucion!='$id_devolucion'and id_devolucion!='1') AND (id_devolucion LIKE '%$busqueda%' OR fecha_devolucion  LIKE '%$busqueda%')) ORDER BY id_devolucion ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_devoluciones WHERE id_devolucion!='$id_devolucion'and id_devolucion!='1' ORDER BY id_devolucion  ASC LIMIT $inicio, $registros";
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
                <th class="text-center">ID Devolucion</th>
                <th class="text-center">fecha Devolucion</th>
                <th class="text-center">Usuario</th>
                <th class="text-center">Equipo</th>
                <th class="text-center">Soporte Tecnico</th>
                <th class="text-center">Observaciones</th>
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
                        <td class="min-width">' . $rows['id_devolucion'] . '</td>
                        <td class="min-width">' . $rows['fecha_devolucion'] . '</td>
                        <td class="min-width">' . $rows['id_usuario'] . '</td>
                        <td class="min-width">' . $rows['id_equipo'] . '</td>
                        <td class="min-width">' . $rows['id_soporte'] . '</td>
                        <td class="min-width">' . $rows['observaciones'] . '</td>
                          
                        <td class="stat"><a href="' . SERVERURL . 'actualizar-devoluciones/' . mainModel::encryption($rows['id_devolucion']) . '/"</input>
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-pencil-square lead"></i>
                            </button>
                        </td>  
                        <td>
                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/devolucionesAjax.php" 
                                method="post" data-form="delete" autocomplete="off"> 		
                                <input type="hidden" name="devoluciones_eliminar" value="' . mainModel::encryption($rows['id_devolucion']) . '"></input>
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
    public function eliminar_devoluciones_controladores()
    {
        $id_devolucion = mainModel::decryption($_POST['devoluciones_eliminar']);
        $id_devolucion = mainModel::limpiar_cadena($id_devolucion);
    
        $check_devoluciones = mainModel::ejecutar_consulta_simple("SELECT id_devolucion  FROM tbl_devoluciones WHERE id_devolucion  ='$id_devolucion'");
        if ($check_devoluciones->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "la ID que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $eliminar_devoluciones = devolucionesModelo::eliminar_devoluciones_modelos($id_devolucion);
    
        if ($eliminar_devoluciones->rowCount() == 1) {
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
   public function datos_devoluciones_controladores($id_devolucion){
    $id_devolucion=mainModel::decryption($id_devolucion);
    return devolucionesModelo::datos_devoluciones_modelos($id_devolucion);
}

public function actualizar_devoluciones_controladores()
{
    $id_devolucion = mainModel::decryption($_POST['id_devolucion_up']);
    $id_devolucion = mainModel::limpiar_cadena($id_devolucion);
    $id_devolucion = $_POST['id_devolucion_up'];

    $check_devoluciones = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_devoluciones WHERE id_devolucion='$id_devolucion'");
    if ($check_devoluciones->rowCount() <= 0) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado.",
            "Texto" => "No hemos encontrado la ID en el sistema",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    } else {
        $campos = $check_devoluciones->fetch();
    }
    
    $id_devolucion = mainModel::limpiar_cadena($_POST['id_devolucion_up']);
    $fecha_devolucion = mainModel::limpiar_cadena($_POST['fecha_devolucion_up']);
    $id_usuario = mainModel::limpiar_cadena($_POST['id_usuario_up']);
    $id_equipo = mainModel::limpiar_cadena($_POST['id_equipo_up']);
    $id_soporte = mainModel::limpiar_cadena($_POST['id_soporte_up']);
    $observaciones = mainModel::limpiar_cadena($_POST['observaciones_up']);

    /* Verificando integridad de los datos */
    if ($id_devolucion == "" || $fecha_devolucion == "" || $id_usuario == "" || $id_equipo == ""  || $id_soporte == "" || $observaciones == "" ) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No has llenado todos los campos que son obligatorios",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }
    if (mainModel::verificar_datos("[0-9]{4,10}", $id_devolucion)) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "El ID no coincide con el formato solicitado",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }

    if (mainModel::verificar_datos("[0-9]{4,10}", $id_usuario)) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "El ID no coincide con el formato solicitado",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }
    if (mainModel::verificar_datos("[0-9]{4,10}", $id_equipo)) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "El ID no coincide con el formato solicitado",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }
    // Validación de fecha
    $fecha_actual = date("Y-m-d");
    if ($fecha_entrega > $fecha_actual) {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "La fecha de entrega no puede ser posterior a la fecha actual",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }
    if ($id_devolucion != $campos['id_devolucion']) {
        $check_devoluciones = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_devoluciones WHERE id_devolucion='$id_devolucion'");
        if ($check_devoluciones->rowCount() > 0) {
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
    $datos_devoluciones_up = [
        "id_devolucion"   => $id_devolucion,
        "fecha_devolucion"           => $fecha_devolucion,
        "id_usuario"      => $id_usuario,
        "id_equipo"         => $id_equipo,
        "id_soporte"             => $id_soporte,
        "observaciones"             => $observaciones,
        
    ];
    if (devolucionesModelo::actualizar_devoluciones_modelos($datos_devoluciones_up)) {
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


