<?php
// Obtener el ID del aprendiz de la URL
if(isset($_GET['id_disponibilidad'])) {
    $id_disponibilidad =$_GET['id_disponibilidad'];
} else {
    // Manejar el caso en el que no se proporciona un ID en la URL
    $id_disponibilidad = "No se proporcionó un ID";
}
?>
<style>
  .row {
    background-color: #b4e4b4;
  }
  .card-style {
    width: ;
    height: ;
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
                                    Lista de Equipos Disponibles
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            
            <div class="card-style mb-30">
                <center>
                    <h6 class="texto"><i class="bi bi-person-check-fill p-1"></i>Equipos Disponibles</h6>
                </center>
                <div class="text-end mb-3">
                    <a href="<?php echo SERVERURL;?>vista-usuario/" class="btn btn-success">Solicitud prestamo equipo</a>
                </div>
                <p class="text-sm mb-20 mt-3">
                ¡Bienvenido! Si estás visualizando equipos disponibles, ¡no dudes en enviar tu solicitud ahora mismo! ¡Estamos aquí para ayudarte a conseguir lo que necesitas!
                </p>
                <div class="table-responsive text-center">
                    <?php
                    require_once  "./controladores/disponibilidadControlador.php";
                    $reg_disponibilidad = new disponibilidadControlador();
                    echo $reg_disponibilidad->paginador_disponibilidad_controladores($pagina[1], 5, "", $pagina[0], "");
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>