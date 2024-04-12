<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['identificacion_reg']) || isset($_POST['usuario_eliminar']) || isset($_POST['identificacion_up'])) {
   
    require_once "../controladores/usuarioControlador.php";
    $reg_usuario = new usuarioControlador();

    /*---------------- Agregar usuario ------------------*/
    if (isset($_POST['identificacion_reg']) && isset($_POST['nombre_reg'])) {
        echo $reg_usuario->agregar_usuario_controladores();
    }

    if (isset($_POST['identificacion_reg']) && isset($_POST['contraseña_reg'])) {
        echo $reg_usuario->agregar_admin_controladores();
    }

    /*---------------- Eliminar usuario ------------------*/
    if (isset($_POST['usuario_eliminar'])) {
        echo $reg_usuario->eliminar_usuario_controladores();
    }

    /*---------------- Actualizar aprendiz ------------------*/
    if (isset($_POST['identificacion_up'])){
        echo $reg_usuario ->actualizar_usuario_controladores();
}}