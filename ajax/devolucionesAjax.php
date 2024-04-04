<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['id_devolucion_reg']) || isset($_POST['devoluciones_eliminar']) || isset($_POST['id_devolucion_up'])) {
   
    require_once "../controladores/devolucionesControlador.php";
    $reg_devoluciones = new devolucionesControlador();

    /*---------------- Agregar devolucion ------------------*/
    if (isset($_POST['id_devolucion_reg']) && isset($_POST['fecha_devolucion_reg'])) {
        echo $reg_devoluciones->agregar_devoluciones_controladores();
    }

    /*---------------- Eliminar devolucion ------------------*/
    if (isset($_POST['devoluciones_eliminar'])) {
        echo $reg_devoluciones->eliminar_devoluciones_controladores();
    }

    /*---------------- Actualizar devolucion ------------------*/
    if (isset($_POST['id_devolucion_up'])){
        echo $reg_devoluciones ->actualizar_devoluciones_controladores();
}
}