<?php
// Obtener el ID del aprendiz de la URL
if(isset($_GET['id_entrega'])) {
    $id_entrega =$_GET['id_entrega'];
} else {
    // Manejar el caso en el que no se proporciona un ID en la URL
    $id_entrega = "No se proporcionó un ID";
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
                                    Lista de Equipos Entregados
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="card-style mb-30">
                <center>
                    <h6 class="texto"><i class="bi bi-person-check-fill p-1"></i>Equipos Entregados</h6>
                </center>
                <p class="text-sm mb-20 mt-3">
                    Visualiza tus registros, recuerda editar tu informacion si hay algo incorrecto.
                </p>
                <div class="table-responsive text-center">
                    <?php
                    require_once  "./controladores/entregaControlador.php";
                    $reg_entrega = new entregaControlador();
                    echo $reg_entrega->paginador_entrega_controladores($pagina[1], 5, "", $pagina[0], "");
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>