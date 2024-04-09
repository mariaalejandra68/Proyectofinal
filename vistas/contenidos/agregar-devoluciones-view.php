<?php
include "./modelos/devolucionesModelo.php";
$reg_equipo = new devolucionesModelo();
$equipo = $reg_equipo->listar_equipos();
$usuario = $reg_equipo->listar_usuario();
$soporte = $reg_equipo->listar_soporte();
$disponibilidad = $reg_equipo->listar_disponibilidad();
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
                                    Agregar Devoluciones
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Agregar Devoluciones</div>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/devolucionesAjax.php" method="POST" data-form="save" autocomplete="off">
                            <div class="row mt-4">
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">ID Devolucion</label>
                                            <input class="form-control" maxlength="10" type="text" name="id_devolucion_reg" pattern="[0-9-]{4,10}" require>
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Fecha Devolucion</label>
                                            <input class="form-control" maxlength="30" type="date" name="fecha_devolucion_reg" require>
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Usuarios</label>
                                            <div class="dropdown bootstrap-select form-control" style="border: 1px solid #ced4da !important; border-radius: 4px !important;">
                                                <select class="form-control selectpicker" data-live-search="true" name="id_usuario_reg" id="input-select-usuario">
                                                    <option>Selecciona</option>
                                                    <?php foreach ($usuario as $fila) : ?>
                                                        <option value="<?php echo $fila['identificacion']; ?>"><?php echo $fila['identificacion']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Equipos</label>
                                        <div class="dropdown bootstrap-select form-control" style="border: 1px solid #ced4da !important; border-radius: 4px !important;">
                                            <select class="form-control selectpicker" data-live-search="true" name="id_equipo_reg" id="input-select-equipo">
                                                <option>Selecciona</option>
                                                <?php foreach ($equipo as $fila) : ?>
                                                    <option value="<?php echo $fila['n_placa']; ?>"><?php echo $fila['n_placa']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Soporte Técnico</label>
                                        <div class="dropdown bootstrap-select form-control" style="border: 1px solid #ced4da !important; border-radius: 4px !important;">
                                            <select class="form-control selectpicker" data-live-search="true" name="id_soporte_reg" id="input-select-soporte">
                                                <option>Selecciona</option>
                                                <?php foreach ($soporte as $fila) : ?>
                                                    <option value="<?php echo $fila['identificacion']; ?>"><?php echo $fila['identificacion']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="form-label">Disponibilidad</label>
                                        <select class="form-control" id="input-select-disponibilidad" name="id_disponibilidad_reg">
                                            <option>Selecciona</option>
                                            <?php foreach ($disponibilidad as $fila) : ?>
                                                <option value="<?php echo $fila['id_disponibilidad']; ?>">
                                                    <?php echo ($fila['id_disponibilidad'] == 1) ? 'Disponible' : 'No disponible'; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Observaciones</label>
                                        <input class="form-control" maxlength="30" type="text" name="observaciones_reg" require>
                                    </div>

                                    <div class="form-group col-md-4 mt-5">
                                        <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" style="font-size: 15px;">Guardar Datos</button>
                                        <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="reset" style="font-size: 15px;">Vaciar Area</button>
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
