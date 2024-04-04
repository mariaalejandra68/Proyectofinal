<?php
// Obtener el ID del aprendiz de la URL
if(isset($_GET['n_placa'])) {
    $n_placa =$_GET['n_placa'];
} else {
    // Manejar el caso en el que no se proporciona un ID en la URL
    $n_placa = "No se proporcionó un ID";
}
?>
<style>
  .row {
    background-color: #b4e4b4;
    /* Otros estilos */
  }
  
</style>

<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Prestamo de computadores</h2>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo SERVERURL; ?>home/">Principal</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="">Usuario</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Lista de Usuario
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="card-style mb-30">
                <center>
                    <h6 class="texto"><i class="bi bi-person-check-fill p-1"></i>usuarios Registrados</h6>
                </center>
                <p class="text-sm mb-20 mt-3">
                    Visualiza tus registros, recuerda editar tu informacion si hay algo incorrecto.
                </p>
                <div class="table-responsive text-center">
                    <?php
                    require_once  "./controladores/usuarioControlador.php";
                    $reg_usuario = new usuarioControlador();
                    echo $reg_usuario->paginador_usuario_controladores($pagina[1], 5, "", $pagina[0], "");
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>