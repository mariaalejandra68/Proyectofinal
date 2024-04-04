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
                                    <a href="<?php echo SERVERURL; ?>disponiblilidad/">Principal</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Formulario de solicitud de préstamo
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Formulario de solicitud de préstamo</div>
                            <form action="<?php echo SERVERURL; ?>controladores/formularioControlador.php" method="POST" autocomplete="off">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="control-label">Nombre</label>
                                            <input class="form-control" maxlength="50" type="text" name="nombre" pattern="[0-9-]{7,10}" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="control-label">Apellidos</label>
                                            <input class="form-control" maxlength="50" type="text" name="apellido" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="control-label">Identificación</label>
                                            <input class="form-control" maxlength="30" type="text" name="identificacion" pattern="[0-9-]{7,10}" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="control-label">Dependencia</label>
                                            <input class="form-control" maxlength="50" type="text" name="dependencia" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,100}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="control-label">Correo</label>
                                            <input class="form-control" maxlength="50" type="email" name="email">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="control-label">Teléfono</label>
                                            <input class="form-control" maxlength="30" type="text" name="telefono" pattern="[0-9-]{7,10}" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="control-label">Sede</label>
                                            <input class="form-control" maxlength="50" type="text" name="sede" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,100}" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="control-label">Asunto</label>
                                            <textarea class="form-control" rows="5" name="asunto" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,}" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-5">
                                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" name="enviar_mensaje" style="font-size: 15px;">Enviar Datos</button>
                                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="reset" style="font-size: 15px;">Vaciar Área</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
