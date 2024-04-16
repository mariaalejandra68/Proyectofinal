<?php
// cargarEquipos.php

$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['usuario'])) {
    $usuarioSeleccionado = $_POST['usuario'];
    require_once "../modelos/traspasoModelo.php";
    $modelo = new traspasoModelo();
    $equipos = $modelo->listar_equipos_por_usuario($usuarioSeleccionado);

    $options = '<option>Selecciona</option>';
    while ($equipo = $equipos->fetch(PDO::FETCH_ASSOC)) {
        $options .= '<option value="' . $equipo['n_placa'] . '">' . $equipo['n_placa'] . '</option>';
    }
    echo $options;
}
?>
