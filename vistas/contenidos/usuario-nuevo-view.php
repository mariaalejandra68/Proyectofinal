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
                        <h2>Prestamos de computadores</h2>
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
                                    <a href="#0">Usuario</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Crear Usuario
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Crear Usuario</div>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save" autocomplete="off">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label class="control-label">Identificación</label>
                                            <input class="form-control" maxlength="10" type="text" name="identificacion_reg" pattern="[0-9-]{1,10}" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="control-label">Nombre</label>
                                            <input class="form-control" maxlength="30" type="text" name="nombre_reg" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mt-3">
                                            <label class="control-label">Dependencia</label>
                                            <input class="form-control" maxlength="30" type="text" name="dependencia_reg" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="control-label">Teléfono</label>
                                            <input class="form-control" maxlength="10" type="text" name="telefono_reg" pattern="[0-9-]{1,10}" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="control-label">Sede</label>
                                            <input class="form-control" maxlength="50" type="text" name="sede_reg" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12 text-center">
                                        <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" style="font-size: 15px;">Guardar Datos</button>
                                        <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="reset" style="font-size: 15px;">Vaciar Área</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
