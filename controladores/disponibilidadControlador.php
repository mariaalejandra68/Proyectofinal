<?php

if ($peticionAjax) {
    require_once "../modelos/equipoModelo.php";
} else {
    require_once "./modelos/equipoModelo.php";
}

class disponibilidadControlador extends equipoModelo
{ 
    /*--------------------- TABLA PAGINADOR ---------------------------*/
    public function paginador_disponibilidad_controladores($pagina, $registros, $n_placa, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_equipos WHERE ((n_placa!='$n_placa' AND n_placa!='1') AND (n_placa LIKE '%$busqueda%' OR n_serial  LIKE '%$busqueda%') AND id_disponibilidad = '1') ORDER BY n_placa ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_equipos WHERE n_placa!='$n_placa' AND n_placa!='1' AND id_disponibilidad = '1' ORDER BY n_placa  ASC LIMIT $inicio, $registros";
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

   
}

   