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
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="form-elements-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30 text-center">
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Registrarse</div>
                            <form action="<?php echo SERVERURL; ?>controladores/loginControlador.php" method="POST" autocomplete="off">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="control-label">No</label>
                                            <input class="form-control" maxlength="50" type="text" name="usuarioId_spc" pattern="[0-9-]{7,10}" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="control-label">Nombre</label>
                                            <input class="form-control" maxlength="50" type="text" name="useUser_spc" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="control-label">Contraseña</label>
                                            <input class="form-control" maxlength="30" type="text" name="usePass_spc" pattern="[0-9-]{7,10}" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="control-label">Identificacion</label>
                                            <input class="form-control" maxlength="50" type="text" name="tbl_usua_id_spc" pattern="[0-9-]{7,10}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="control-label">Tipo Usuario</label>
                                            <input class="form-control" maxlength="30" type="text" name="id_tipo_usu_spc" pattern="[0-9-]{7,10}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-5">
                                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" name="enviar_mensaje" style="font-size: 15px;">Guardar Datos</button>
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
