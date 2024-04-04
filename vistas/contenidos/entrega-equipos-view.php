<?php
include "./modelos/entregaModelo.php";
$reg_equipo = new entregaModelo();
$equipo = $reg_equipo->listar_equipos();
$usuario = $reg_equipo->listar_usuario();
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
                                    Entrega de Equipos
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Entrega de Equipos</div>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/entregaAjax.php" method="POST" data-form="save" autocomplete="off">
                                <div class="row mt-4">
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">ID Entrega</label>
                                        <input class="form-control" maxlength="10" type="text" name="id_entrega_reg" pattern="[0-9-]{7,10}" required>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Fecha Entrega</label>
                                        <input class="form-control" maxlength="10" type="date" name="fecha_entrega_reg" required>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Ciudad Entrega</label>
                                        <input class="form-control" maxlength="30" type="text" name="ciudad_entrega_reg" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Código TIC SENA</label>
                                        <input class="form-control" maxlength="10" type="text" name="codigo_tic_sena_reg" pattern="[0-9-]{7,10}" required>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Código Sitio</label>
                                        <input class="form-control" maxlength="10" type="text" name="codigo_sitio_reg" pattern="[0-9-]{7,10}" required>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Nombre Representante</label>
                                        <input class="form-control" maxlength="30" type="text" name="nombre_representante_reg" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Documento Representante</label>
                                        <input class="form-control" maxlength="10" type="text" name="documento_representante_reg" pattern="[0-9-]{7,10}" required>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Usuarios</label>
                                        <select class="form-control" id="input-select-usuario" name="id_usuario_reg">
                                            <option>Selecciona</option>
                                            <?php foreach ($usuario as $fila) : ?>
                                                <option value="<?php echo $fila['identificacion']; ?>"><?php echo $fila['identificacion']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Equipos</label>
                                        <select class="form-control" id="input-select-equipo" name="id_equipo_reg">
                                            <option>Selecciona</option>
                                            <?php foreach ($equipo as $fila) : ?>
                                                <option value="<?php echo $fila['n_placa']; ?>"><?php echo $fila['n_placa']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="row">
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
                                    </div>
                                </div>
                                <div class="form-group col-md-12 mt-5">
                                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="submit" style="font-size: 15px;">Guardar Datos</button>
                                    <button class="main-btn success-btn-outline rounded-full btn-hover m-1" type="reset" style="font-size: 15px;">Vaciar Area</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
