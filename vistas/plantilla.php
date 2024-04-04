<!DOCTYPE html>
<html lang="es">
<?php
session_start(['name' => 'SPC']);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" href="<?php echo SERVERURL; ?>view/img/Logo_fondo.png">
    <?php include "./vistas/include/css.php"; ?>
</head>

<body>
    <?php
    $peticionAjax = false;
    require_once "./controladores/vistasControlador.php";
    $IV = new vistasControlador();
    $vistas = $IV->obtener_vistas_controladores();

    if ($vistas == "login" || $vistas == "404") {
        require_once "./vistas/contenidos/" . $vistas . "-view.php";
    } else {
        $pagina = explode("/", $_GET['views']);
        require_once "./controladores/loginControlador.php";
        $lc = new loginControlador();

        if (
            !isset($_SESSION['token_spc']) || !isset($_SESSION['tbl_usua_id_spc'])
        ) {
            echo $lc->forzar_cierre_sesion_controladores();
            exit();
        }
    ?>
        <?php include "vistas/include/sideBar.php"; ?>
        <main class="main-wrapper">
            <?php include "vistas/include/navBar.php"; ?>
            <div id="content">
                <?php include $vistas; ?>
                <?php include "vistas/include/foother.php"; ?>
            </div>
        </main>
    <?php
        include "./vistas/include/LogOut.php";
    }
    include "./vistas/include/js.php"; ?>
</body>

</html>