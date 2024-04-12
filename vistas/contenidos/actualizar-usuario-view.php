<?php
include "./modelos/usuarioModelo.php";
$reg_equipo = new usuarioModelo();
?>
<style>
  .form-elements-wrapper {
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
                        <h2></h2>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo SERVERURL; ?>usuario-lista/">Lista de Usuarios</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Actualizar informacion
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="form-elements-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30 text-center">
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus p-1"></i>Actualiza tu información</div>
                            <h6 class="text-center texto mt-2" id="selected-person"></h6>
                            <?php
                            require_once "./controladores/usuarioControlador.php";
                            $reg_usuario = new usuarioControlador();

                            $datos_usuario = $reg_usuario->datos_usuario_controladores($pagina[1]);

                            if ($datos_usuario->rowCount() == 1) {
                                $campos = $datos_usuario->fetch();
                            ?>
                                <form class="mt-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="update" autocomplete="off">
                                    <input type="hidden" name="usuario_up" value="<?php echo $pagina[1]; ?>">
                                    <div class="row mt-4">
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Identificación</label>
                                            <input class="form-control" maxlength="10" type="text" name="identificacion_up" value="<?php echo $campos['identificacion']; ?>" pattern="[0-9-]{2,10}" readonly require>
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Nombre</label>
                                            <input class="form-control" maxlength="30" type="text" name="nombre_up" value="<?php echo $campos['nombre']; ?>" require>
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Dependencia </label>
                                            <input class="form-control" maxlength="30" type="text" name="dependencia_up" value="<?php echo $campos['dependencia']; ?>" require>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Telefono</label>
                                            <input class="form-control" maxlength="50" type="text" name="telefono_up" value="<?php echo $campos['telefono']; ?>" pattern="[0-9-]{2,10}" require>
                                        </div>
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Sede</label>
                                            <input class="form-control" maxlength="10" type="text" name="sede_up" value="<?php echo $campos['sede']; ?>" require>
                                        </div>
                                    </div>

                                    <div class="form-group text-align-end mt-3">
                                        <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" style="font-size: 15px;">Actualizar Datos</button>
                                    </div>
                        </div>
                        </form>
                    <?php } else { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <h4 class="alert-heading">Ocurrio un error</h4>
                            <p class="mb-0">Lo sentimos, no podemos mostrar la informacion solicitada</p>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>