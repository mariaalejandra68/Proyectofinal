<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['id_equipo_reg']) || isset($_POST['traspaso_eliminar'])) {
   
    require_once "../controladores/traspasoControlador.php";
    $reg_traspaso = new traspasoControlador();

    /*---------------- Agregar equipo ------------------*/
    if (isset($_POST['id_equipo_reg']) && isset($_POST['id_equipo_reg'])) {
        echo $reg_traspaso->agregar_traspaso_controladores();
    }

    /*---------------- Eliminar equipo ------------------*/
    if (isset($_POST['traspaso_eliminar'])) {
        echo $reg_traspaso->eliminar_traspaso_controladores();
    }
}