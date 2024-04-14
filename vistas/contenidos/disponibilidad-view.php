
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
                                    <a href="<?php echo SERVERURL; ?>vista-usuario/">Formulario</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Lista de tus equipos
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            
            <div class="card-style mb-30">
                <center>
                    <h3 class="texto"><i class="bi bi-person-check-fill p-1"></i>Tus equipos</h3>
                </center>
                <!-- <div class="text-end mb-3">
                    <a href="<?php //echo SERVERURL;?>vista-usuario/" class="btn btn-success">Solicitud prestamo equipo</a>
                </div> -->
                <p class="text-sm mb-20 mt-3">
                Equipos a tu disposición
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