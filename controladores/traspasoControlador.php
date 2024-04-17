<?php

if ($peticionAjax) {
    require_once "../modelos/traspasoModelo.php";
} else {
    require_once "./modelos/traspasoModelo.php";
}

class traspasoControlador extends traspasoModelo
{
    /*------------- CONTROLADOR AGREGAR EQUIPO -----------------------*/
    public function agregar_traspaso_controladores(){

        $id_usuario_entrega = mainModel::limpiar_cadena($_POST['id_usuario_entrega_reg']);
        $id_usuario_recibe = mainModel::limpiar_cadena($_POST['id_usuario_recibe_reg']);
        $id_equipo = mainModel::limpiar_cadena($_POST['id_equipo_reg']);
        


        /* Verificando integridad de los datos */
        if ($id_usuario_entrega == "" || $id_usuario_recibe == "" || $id_equipo == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{4,10}", $id_usuario_entrega)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "la identificacion del usuario que entrega no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{4,10}", $id_usuario_recibe)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "la identificacion del usuario que recibe no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9]{4,10}", $id_equipo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La identificacion del equipo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $datos_traspaso_add  = [
            "id_usuario_entrega"=> $id_usuario_entrega,
            "id_usuario_recibe"=> $id_usuario_recibe,
            "id_equipo"=> $id_equipo
        ];
        $agregar_traspaso = traspasoModelo::agregar_traspaso_modelos($datos_traspaso_add);
        if ($agregar_traspaso->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Traspaso Registrado",
                "Texto" => "El traspaso ha sido registrado exitosamente.",
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
    /*------------- FIN AGREGAR EQUIPO -----------------------------*/
    
    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_traspaso_controladores($pagina, $registros, $id_traspaso, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $id_traspaso = mainModel::limpiar_cadena($id_traspaso);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";
        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_traspaso WHERE id_equipo  LIKE '%$busqueda%' ORDER BY id_traspaso ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_traspaso WHERE id_traspaso!='$id_traspaso'and id_traspaso!='1' ORDER BY id_traspaso  ASC LIMIT $inicio, $registros";
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
                <th class="text-center">ID traspaso</th>
                <th class="text-center">Fecha traspaso</th>
                <th class="text-center">Usuario entrega</th>
                <th class="text-center">Usuario recibe</th>
                <th class="text-center">Equipo</th>
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
                        <td class="min-width">' . $rows['id_traspaso'] . '</td>
                        <td class="min-width">' . $rows['fecha_traspaso'] . '</td>
                        <td class="min-width">' . $rows['id_usuario_entrega'] . '</td>
                        <td class="min-width">' . $rows['id_usuario_recibe'] . '</td>
                        <td class="min-width">' . $rows['id_equipo'] . '</td>
                          
                        <td>
                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/equipoAjax.php" 
                                method="post" data-form="delete" autocomplete="off"> 		
                                <input type="hidden" name="traspaso_eliminar" value="' . mainModel::encryption($rows['id_traspaso']) . '"></input>
                                <button type="submit" class="btn btn-danger">
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
            $tabla .= '<p class="text-end text-muted mt-5"> Lista de traspaso' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 3);
        }

        return $tabla;

    }/*------------------- FIN TABLA ---------------------------------*/

    /*------------- CONTROLADOR ELIMINAR TRASPASO--------------------*/
    public function eliminar_traspaso_controladores()
    {
        $id_traspaso = mainModel::decryption($_POST['traspaso_eliminar']);
        $id_traspaso= mainModel::limpiar_cadena($id_traspaso);
    
        $check_traspaso = mainModel::ejecutar_consulta_simple("SELECT id_traspaso  FROM tbl_traspaso WHERE id_traspaso  ='$id_traspaso'");
        if ($check_traspaso->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El traspaso que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $eliminar_traspaso = traspasoModelo::eliminar_traspaso_modelos($id_traspaso);
    
        if ($eliminar_traspaso->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Eliminado",
                "Texto" => "Se ha eliminado el traspaso exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos podido eliminar el traspaso.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    
   /*-------------- FIN ELIMINAR TRASPASO --------------------------*/

   /*------------- CONTROLADOR ACTUALIZAR TRASPASO -----------------------*/
    public function datos_traspaso_controladores($id_traspaso){
        $id_traspaso=mainModel::decryption($id_traspaso);
        return traspasoModelo::datos_traspaso_modelos($id_traspaso);
    }
    public function actualizar_traspaso_controladores()
    {
        $id_traspaso = mainModel::decryption($_POST['id_traspaso_up']);
        $id_traspaso = mainModel::limpiar_cadena($id_traspaso);
        

        $check_traspaso = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_traspaso WHERE id_traspaso ='$id_traspaso'");
        if ($check_traspaso->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No se pudo encontrar el traspaso",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_traspaso->fetch();
        }
        $id_usuario_entrega = mainModel::limpiar_cadena($_POST['id_usuario_entrega_up']);
        $id_usuario_recibe = mainModel::limpiar_cadena($_POST['id_usuario_recibe_up']);
        $id_equipo = mainModel::limpiar_cadena($_POST['id_equipo_up']);

        /* Verificando integridad de los datos */
        if ($id_usuario_entrega == "" || $id_usuario_recibe == "" || $id_equipo == "" ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{2,10}", $id_usuario_entrega)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El n_placa no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{2,10}", $id_usuario_recibe)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El serial no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9]{2,10}", $id_equipo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La placa no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $datos_traspaso_up = [
            "id_usuario_entrega"  => $id_usuario_entrega,
            "id_usuario_recibe"   => $id_usuario_recibe,
            "id_equipo"           => $id_equipo,

        ];
        if (traspasoModelo::actualizar_traspaso_modelos($datos_traspaso_up)) {
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
    /*------------------ FIN ACTUALIZAR traspaso-----------------------*/


