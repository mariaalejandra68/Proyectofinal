<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['identificacion_reg'])) {
   
    require_once "../controladores/soporteControlador.php";
    $reg_soporte = new soporteControlador();

    /*---------------- Agregar devolucion ------------------*/
    if (isset($_POST['identificacion_reg']) && isset($_POST['nombre_reg'])) {
        echo $reg_soporte->agregar_soporte_controladores();
    }

}