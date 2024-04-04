<?php
include "./modelos/equipoModelo.php";
$reg_usuario = new equipoModelo();
$usuario = $reg_usuario->listar_usuario();
$disponibilidad = $reg_usuario->listar_disponibilidad();
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
                                    Agregar Equipo
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Agregar Equipo</div>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/equipoAjax.php" method="POST" data-form="save" autocomplete="off">
                                <div class="row mt-4">
                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">No. de Placa</label>
                                        <input class="form-control" maxlength="10" type="text" name="n_placa_reg" pattern="[0-9-]{4,10}" require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">No. de Serial</label>
                                        <input class="form-control" maxlength="30" type="text" name="n_serial_reg" require>
                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Descripcion</label>
                                        <input class="form-control" maxlength="30" type="text" name="descripcion_reg" require>
                                    </div>
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


                                    <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Usuario</label>
                                        <!-- Campo de selección para el usuario -->
                                        <select class="form-control" id="input-select-usuario" name="id_usuario_reg">
                                            <option>Selecciona</option>
                                            <?php foreach ($usuario as $fila) : ?>
                                                <option value="<?php echo $fila['identificacion']; ?>"><?php echo $fila['identificacion']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
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