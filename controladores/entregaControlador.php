<?php

if ($peticionAjax) {
    require_once "../modelos/entregaModelo.php";
} else {
    require_once "./modelos/entregaModelo.php";
}

class entregaControlador extends entregaModelo
{
    /*------------- CONTROLADOR AGREGAR ENTREGA -----------------------*/
    public function agregar_entrega_controladores(){

        $id_entrega = mainModel::limpiar_cadena($_POST['id_entrega_reg']);
        $fecha_entrega = mainModel::limpiar_cadena($_POST['fecha_entrega_reg']);
        $ciudad_entrega = mainModel::limpiar_cadena($_POST['ciudad_entrega_reg']);
        $codigo_tic_sena = mainModel::limpiar_cadena($_POST['codigo_tic_sena_reg']);
        $codigo_sitio = mainModel::limpiar_cadena($_POST['codigo_sitio_reg']);
        $nombre_representante = mainModel::limpiar_cadena($_POST['nombre_representante_reg']);
        $documento_representante = mainModel::limpiar_cadena($_POST['documento_representante_reg']);
        $id_usuario = mainModel::limpiar_cadena($_POST['id_usuario_reg']);
        $id_equipo = mainModel::limpiar_cadena($_POST['id_equipo_reg']);
    
        /* Verificando integridad de los datos */
    
        if ($id_entrega == "" || $fecha_entrega == "" || $ciudad_entrega == "" || $codigo_tic_sena == "" || $codigo_sitio == "" || $nombre_representante == "" || $documento_representante == "" || $id_usuario == "" || $id_equipo == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{4,10}", $id_entrega)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Identificación no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    
    
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $ciudad_entrega)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La cuidad no coincide con el formato solicitado",
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
        
        // Verificar si el equipo ya ha sido entregado a otro usuario
        $check_equipo_entregado = mainModel::ejecutar_consulta_simple("SELECT id_entrega FROM tbl_entrega WHERE id_equipo='$id_equipo'");
        if ($check_equipo_entregado->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "El equipo ya ha sido entregado a otro usuario",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    
        $check_entrega = mainModel::ejecutar_consulta_simple("SELECT id_entrega FROM tbl_entrega WHERE id_entrega='$id_entrega'");
        if ($check_entrega->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "La identificación ingresada ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $datos_entrega_add  = [
            "id_entrega"=> $id_entrega,
            "fecha_entrega"=> $fecha_entrega,
            "ciudad_entrega"=> $ciudad_entrega, 
            "codigo_tic_sena"=> $codigo_tic_sena,
            "codigo_sitio"=> $codigo_sitio,
            "nombre_representante"=> $nombre_representante,
            "documento_representante"=> $documento_representante,
            "id_usuario"=> $id_usuario,
            "id_equipo"=> $id_equipo
        ];
    
        $agregar_entrega = entregaModelo::agregar_entrega_modelos($datos_entrega_add);
        if ($agregar_entrega->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Entrega Registrada",
                "Texto" => "La entrega ha sido registrada exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido registrar la entrega.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }
    



    
    
    /*------------- FIN AGREGAR ENTREGA -----------------------------*/
    
    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_entrega_controladores($pagina, $registros, $id_entrega, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $id_entrega = mainModel::limpiar_cadena($id_entrega);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";
        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_entrega WHERE ((id_entrega!='$id_entrega'and id_entrega!='1') AND (id_entrega LIKE '%$busqueda%' OR fecha_entrega  LIKE '%$busqueda%')) ORDER BY id_entrega ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_entrega WHERE id_entrega!='$id_entrega'and id_entrega!='1' ORDER BY id_entrega  ASC LIMIT $inicio, $registros";
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
                <th class="text-center">ID Entrega</th>
                <th class="text-center">Fecha Entrega</th>
                <th class="text-center">Ciudad Entrega</th>
                <th class="text-center">Codigo tic Sena</th>
                <th class="text-center">Codigo Sitio</th>
                <th class="text-center">Nombre Representante</th>
                <th class="text-center">Documento Representante</th>
                <th class="text-center">Usuario</th>
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
                        <td class="min-width">' . $rows['id_entrega'] . '</td>
                        <td class="min-width">' . $rows['fecha_entrega'] . '</td>
                        <td class="min-width">' . $rows['ciudad_entrega'] . '</td>
                        <td class="min-width">' . $rows['codigo_tic_sena'] . '</td>
                        <td class="min-width">' . $rows['codigo_sitio'] . '</td>
                        <td class="min-width">' . $rows['nombre_representante'] . '</td>
                        <td class="min-width">' . $rows['documento_representante'] . '</td>
                        <td class="min-width">' . $rows['id_usuario'] . '</td>
                        <td class="min-width">' . $rows['id_equipo'] . '</td>
                          
                        <td class="stat"><a href="' . SERVERURL . 'actualizar-entregados/' . mainModel::encryption($rows['id_entrega']) . '/"</input>
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-pencil-square lead"></i>
                            </button>
                        </td>  
                        <td>
                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/entregaAjax.php" 
                                method="post" data-form="delete" autocomplete="off"> 		
                                <input type="hidden" name="entrega_eliminar" value="' . mainModel::encryption($rows['id_entrega']) . '"></input>
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

    /*------------- CONTROLADOR ELIMINAR ENTREGA --------------------*/
    public function eliminar_entrega_controladores()
    {
        $id_entrega = mainModel::decryption($_POST['entrega_eliminar']);
        $id_entrega = mainModel::limpiar_cadena($id_entrega);
    
        $check_entrega = mainModel::ejecutar_consulta_simple("SELECT id_entrega  FROM tbl_entrega WHERE id_entrega  ='$id_entrega'");
        if ($check_entrega->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "la entrega que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $eliminar_entrega = entregaModelo::eliminar_entrega_modelos($id_entrega);
    
        if ($eliminar_entrega->rowCount() == 1) {
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
                "Texto" => "No hemos podido eliminar la entrega.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    
   /*-------------- FIN ELIMINAR ENTREGA --------------------------*/

   /*------------- CONTROLADOR ACTUALIZAR ENTREGA -----------------------*/
    public function datos_entrega_controladores($id_entrega){
        $id_entrega=mainModel::decryption($id_entrega);
        return entregaModelo::datos_entrega_modelos($id_entrega);
    }
    public function actualizar_entrega_controladores()
    {
        $id_entrega = mainModel::decryption($_POST['id_entrega_up']);
        $id_entrega = mainModel::limpiar_cadena($id_entrega);
        $id_entrega_lleno = ($_POST['id_entrega_up']);
        
        

        $check_entrega = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_entrega WHERE id_entrega='$id_entrega_lleno'");
        if ($check_entrega->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos encontrado la entrega en el sistema.$id_entrega_lleno",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_entrega->fetch();
        }
        $id_entrega = mainModel::limpiar_cadena($_POST['id_entrega_up']);
        $fecha_entrega = mainModel::limpiar_cadena($_POST['fecha_entrega_up']);
        $ciudad_entrega = mainModel::limpiar_cadena($_POST['ciudad_entrega_up']);
        $codigo_tic_sena = mainModel::limpiar_cadena($_POST['codigo_tic_sena_up']);
        $codigo_sitio = mainModel::limpiar_cadena($_POST['codigo_sitio_up']);
        $nombre_representante = mainModel::limpiar_cadena($_POST['nombre_representante_up']);
        $documento_representante = mainModel::limpiar_cadena($_POST['documento_representante_up']);
        $id_usuario = mainModel::limpiar_cadena($_POST['id_usuario_up']);
        $id_equipo = mainModel::limpiar_cadena($_POST['id_equipo_up']);

        /* Verificando integridad de los datos */
        if ($id_entrega == "" || $fecha_entrega == "" || $ciudad_entrega == "" || $codigo_tic_sena == "" || $codigo_sitio == "" || $nombre_representante == "" || $documento_representante == "" || $id_usuario == "" || $id_equipo == "" ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{4,10}", $id_entrega)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Identificación no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $ciudad_entrega)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La ciudad no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($id_entrega != $campos['id_entrega']) {
            $check_entrega = mainModel::ejecutar_consulta_simple("SELECT id_entrega FROM tbl_entrega WHERE id_entrega='$id_entrega_lleno'");
            if ($check_entrega->rowCount() > 0) {
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
        $datos_entrega_up = [
            "id_entrega"=> $id_entrega,
            "fecha_entrega"=> $fecha_entrega,
            "ciudad_entrega"=> $ciudad_entrega,
            "codigo_tic_sena"=> $codigo_tic_sena,
            "codigo_sitio"=> $codigo_sitio,
            "nombre_representante"=> $nombre_representante,
            "documento_representante"=> $documento_representante,
            "id_usuario"=> $id_usuario,
            "id_equipo"=> $id_equipo
            
        ];
        if (entregaModelo::actualizar_entrega_modelos($datos_entrega_up)) {
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

}   /*------------------ FIN ACTUALIZAR ENTREGA-----------------------*/


