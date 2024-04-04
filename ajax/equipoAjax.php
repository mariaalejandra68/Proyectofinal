<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['n_placa_reg']) || isset($_POST['equipo_eliminar']) || isset($_POST['n_placa_up'])) {
   
    require_once "../controladores/equipoControlador.php";
    $reg_equipo = new equipoControlador();

    /*---------------- Agregar equipo ------------------*/
    if (isset($_POST['n_placa_reg']) && isset($_POST['n_serial_reg'])) {
        echo $reg_equipo->agregar_equipo_controladores();
    }

    /*---------------- Eliminar equipo ------------------*/
    if (isset($_POST['equipo_eliminar'])) {
        echo $reg_equipo->eliminar_equipo_controladores();
    }

    /*---------------- Actualizar equipo ------------------*/
    if (isset($_POST['n_placa_up'])){
        echo $reg_equipo ->actualizar_equipo_controladores();
}
}