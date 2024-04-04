<?php
if ($peticionAjax) {
    require_once "../modelos/loginModelo.php";
} else {
    require_once "./modelos/loginModelo.php";
}
class loginControlador extends loginModelo
{
    /*---------CONTROLADOR INICIAR SECCION---------------*/
    public function iniciar_sesion_controladores()
{
    $correo = mainModel::limpiar_cadena($_POST['administrador_log']);
    $clave = mainModel::limpiar_cadena($_POST['clave_log']);

    $datos_login = [
        "correo" => $correo,
        "Contra" => $clave
    ];

    $iniciar_sesion = loginModelo::iniciar_sesion_modelos($datos_login);

    if ($iniciar_sesion->rowCount() == 1) {
        $row = $iniciar_sesion->fetch();

        session_start(['name' => 'SPC']);
        $_SESSION['usuarioId_spc'] = $row['usuarioId'];
        $_SESSION['useUser_spc'] = $row['useUser'];
        $_SESSION['usePass_spc'] = $row['usePass'];
        $_SESSION['tbl_usua_id_spc'] = $row['tbl_usua_id'];
        $_SESSION['id_tipo_usu_spc'] = $row['id_tipo_usu'];
        $_SESSION['token_spc'] = md5(uniqid(mt_rand(), true));
        

        // Redireccionar después de iniciar sesión
        if($_SESSION['id_tipo_usu_spc']==1){
            header("Location: " . SERVERURL . "home/");
            exit();
        }else{
            header("Location: " . SERVERURL . "disponibilidad/");
        }
         // Detener el script después de la redirección
    } elseif ($correo == "" || $clave == "") {
        // Mostrar mensaje de error si faltan campos
        echo '
            <script>
                Swal.fire({
                    title: "ERROR",
                    text: "Debes llenar todos los campos que son obligatorios",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            </script>
        ';
    } else {
        // Mostrar mensaje de error si las credenciales son incorrectas
        echo '
            <script>
                Swal.fire({
                    title: "Usuario y contraseña",
                    text: "Usuario y contraseña son incorrectos",
                    icon: "error",
                    confirmButtonText: "Aceptar"
                });
            </script>
        ';
    }
}


    /*---------FORZAR CIERRE DE SECCION---------------*/
    public function forzar_cierre_sesion_controladores()
    {
        session_unset();
        session_destroy();
        if (headers_sent()) {
            echo "<script> window.location.href='" . SERVERURL . "login/'; </script>";
            exit(); // Detener el script después de la redirección
        } else {
            header("Location: " . SERVERURL . "login/");
            exit(); // Detener el script después de la redirección
        }
    } //fin cierre

    /*---------CONTROLADOR CIERRE DE SECCION---------------*/
    public function cerrar_sesion_controladores()
    {
        session_start(['name' => 'SPC']); 
        $token = mainModel::limpiar_cadena($_POST['token']);
        $nombre = mainModel::limpiar_cadena($_POST['useUser']);

        if ($token == $_SESSION['token_spc'] && $nombre == $_SESSION['tbl_usua_id_spc']) {
            session_unset();
            session_destroy();
            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => SERVERURL . "login/",
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error",
                "Texto" => "No se ha podido cerrar sesion",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }
    
}//fin controlador

