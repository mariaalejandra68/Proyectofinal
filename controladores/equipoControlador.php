<?php

if ($peticionAjax) {
    require_once "../modelos/equipoModelo.php";
} else {
    require_once "./modelos/equipoModelo.php";
}

class equipoControlador extends equipoModelo
{
    /*------------- CONTROLADOR AGREGAR EQUIPO -----------------------*/
    public function agregar_equipo_controladores(){

        $n_placa = mainModel::limpiar_cadena($_POST['n_placa_reg']);
        $n_serial = mainModel::limpiar_cadena($_POST['n_serial_reg']);
        $descripcion = mainModel::limpiar_cadena($_POST['descripcion_reg']);
        $id_disponibilidad = mainModel::limpiar_cadena($_POST['id_disponibilidad_reg']);
        //$id_usuario = mainModel::limpiar_cadena($_POST['id_usuario_reg']);


        /* Verificando integridad de los datos */
        if ($n_placa == "" || $n_serial == "" || $descripcion == "" || $id_disponibilidad == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{4,10}", $n_placa)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El nomero de placa no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $n_serial)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El serial no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,100}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La descripcion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        $check_equipo = mainModel::ejecutar_consulta_simple("SELECT n_placa FROM tbl_equipos WHERE n_placa='$n_placa'");
        if ($check_equipo->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error Inesperado",
                "Texto" => "El n_placa ingresada ya se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $datos_equipo_add  = [
            "n_placa"=> $n_placa,
            "n_serial"=> $n_serial,
            "descripcion"=> $descripcion,
            "id_disponibilidad"=> $id_disponibilidad,
            //"id_usuario"=> $id_usuario
        ];
        $agregar_equipo = equipoModelo::agregar_equipo_modelos($datos_equipo_add);
        if ($agregar_equipo->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Equipo Registrado",
                "Texto" => "El equipo ha sido registrado exitosamente.",
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
    public function paginador_equipo_controladores($pagina, $registros, $n_placa, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $n_placa = mainModel::limpiar_cadena($n_placa);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";
        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_equipos WHERE ((n_placa!='$n_placa'and n_placa!='1') AND (n_placa LIKE '%$busqueda%' OR n_serial  LIKE '%$busqueda%')) ORDER BY n_placa ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_equipos WHERE n_placa!='$n_placa'and n_placa!='1' ORDER BY n_placa  ASC LIMIT $inicio, $registros";
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
                <th class="text-center">No. de Placa</th>
                <th class="text-center">No. de Serial</th>
                <th class="text-center">Descripcion</th>
                <th class="text-center">Disponibilidad</th>
                <th class="text-center">Usuario</th>
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
                        <td class="min-width">' . $rows['n_placa'] . '</td>
                        <td class="min-width">' . $rows['n_serial'] . '</td>
                        <td class="min-width">' . $rows['descripcion'] . '</td>
                        <td class="min-width">' . $rows['id_disponibilidad'] . '</td>
                        <td class="min-width">' . $rows['id_usuario'] . '</td>
                          
                        <td class="stat"><a href="' . SERVERURL . 'actualizar-equipo/' . mainModel::encryption($rows['n_placa']) . '/"</input>
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-pencil-square lead"></i>
                            </button>
                        </td>  
                        <td>
                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/equipoAjax.php" 
                                method="post" data-form="delete" autocomplete="off"> 		
                                <input type="hidden" name="equipo_eliminar" value="' . mainModel::encryption($rows['n_placa']) . '"></input>
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
            $tabla .= '<p class="text-end text-muted mt-5"> Lista de equipo' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 3);
        }

        return $tabla;

    }/*------------------- FIN TABLA ---------------------------------*/

    /*------------- CONTROLADOR ELIMINAR EQUIPO--------------------*/
    public function eliminar_equipo_controladores()
    {
        $n_placa = mainModel::decryption($_POST['equipo_eliminar']);
        $n_placa= mainModel::limpiar_cadena($n_placa);
    
        $check_equipo = mainModel::ejecutar_consulta_simple("SELECT n_placa  FROM tbl_equipos WHERE n_placa  ='$n_placa'");
        if ($check_equipo->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El equipo que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $eliminar_equipo = equipoModelo::eliminar_equipo_modelos($n_placa);
    
        if ($eliminar_equipo->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiarTime",
                "Titulo" => "Eliminado",
                "Texto" => "Se ha eliminado el equipo exitosamente.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No hemos podido eliminar al equipo.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    
   /*-------------- FIN ELIMINAR EQUIPO --------------------------*/

   /*------------- CONTROLADOR ACTUALIZAR EQUIPO -----------------------*/
    public function datos_equipo_controladores($n_placa){
        $n_placa=mainModel::decryption($n_placa);
        return equipoModelo::datos_equipo_modelos($n_placa);
    }
    public function actualizar_equipo_controladores()
    {
        $n_placa = mainModel::decryption($_POST['n_placa_up']);
        $n_placa = mainModel::limpiar_cadena($n_placa);
        $_prim = $_POST['n_placa_up'];

        $check_equipo = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_equipos WHERE n_placa ='$_prim'");
        if ($check_equipo->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado.",
                "Texto" => "No se pudo encontrar el equip0",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_equipo->fetch();
        }
        $n_placa = mainModel::limpiar_cadena($_POST['n_placa_up']);
        $n_serial = mainModel::limpiar_cadena($_POST['n_serial_up']);
        $descripcion = mainModel::limpiar_cadena($_POST['descripcion_up']);
        $id_disponibilidad = mainModel::limpiar_cadena($_POST['id_disponibilidad_up']);
        $id_usuario = mainModel::limpiar_cadena($_POST['id_usuario_up']);

        /* Verificando integridad de los datos */
        if ($n_placa == "" || $n_serial == "" || $descripcion == "" || $id_disponibilidad == ""  || $id_usuario == "" ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{2,10}", $n_placa)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El n_placa no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}", $n_serial)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El serial no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,100}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La descripcion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($n_placa != $campos['n_placa']) {
            $check_equipo = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_equipos WHERE n_placa='$n_placa'");
            if ($check_equipo->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error Inesperado",
                    "Texto" => "La n_placa ingresada ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        $datos_equipo_up = [
            "n_placa"             => $n_placa,
            "n_serial"            => $n_serial,
            "descripcion"         => $descripcion,
            "id_disponibilidad"   => $id_disponibilidad,
            "id_usuario"          => $id_usuario,

           
        ];
        if (equipoModelo::actualizar_equipo_modelos($datos_equipo_up)) {
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
    /*------------------ FIN ACTUALIZAR EQUIPO-----------------------*/


