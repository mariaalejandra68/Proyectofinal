<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['id_entrega_reg']) || isset($_POST['entrega_eliminar']) || isset($_POST['id_entrega_up'])) {
   
    require_once "../controladores/entregaControlador.php";
    $reg_entrega = new entregaControlador();

    /*---------------- Agregar entrega ------------------*/
    if (isset($_POST['id_entrega_reg']) && isset($_POST['fecha_entrega_reg'])) {
        echo $reg_entrega->agregar_entrega_controladores();
    }
       /*---------------- Eliminar entrega ------------------*/
    if (isset($_POST['entrega_eliminar'])) {
        echo $reg_entrega->eliminar_entrega_controladores();
    }

    /*---------------- Actualizar entrega ------------------*/
    if (isset($_POST['id_entrega_up'])){
        echo $reg_entrega ->actualizar_entrega_controladores();
    }

}