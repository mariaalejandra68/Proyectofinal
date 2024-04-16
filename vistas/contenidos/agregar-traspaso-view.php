<?php
include "./modelos/traspasoModelo.php";
$reg_usuario = new traspasoModelo();
$usuario = $reg_usuario->listar_usuario();
$equipo = $reg_usuario->listar_equipos();
$usuario2 = $reg_usuario->listar_usuario();
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
                                <li class="breadcrumb-item active" aria-current="page">
                                    Agregar Traspaso
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
                            <div class="text-center mt-2 texto" style="font-size: 25px;"><i class="bi bi-person-plus lead p-1"></i>Agregar Traspaso</div>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/traspasoAjax.php" method="POST" data-form="save" autocomplete="off">
                            <div class="row mt-4">
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Usuario quien entrega</label>
                                    <div class="dropdown bootstrap-select form-control" style="border: 1px solid #ced4da !important; border-radius: 4px !important;">
                                        <select class="form-control selectpicker" data-live-search="true" name="id_usuario_entrega_reg" id="input-select-usuario-entrega"
                                        onchange="cargarEquipos()">
                                            <option>Selecciona</option>
                                            <?php foreach ($usuario as $fila) : ?>
                                                <option value="<?php echo $fila['identificacion']; ?>"><?php echo $fila['identificacion']. ' - ' . $fila['nombre']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Campos para Usuario quien entrega -->
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Equipos</label>
                                    <div class="dropdown bootstrap-select form-control" style="border: 1px solid #ced4da !important; border-radius: 4px !important;">
                                        <select class="form-control selectpicker" name="id_equipo_reg" id="input-select-equipo">
                                            <option>Selecciona</option>
                                            <?php foreach ($equipo as $fila) : ?>
                                                <option value="<?php echo $fila['n_placa']; ?>"><?php echo $fila['n_placa'] . ' - ' . $fila['descripcion']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        
                                    </div>
                                </div>

                                
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Usuario que recibe</label>
                                    <div class="dropdown bootstrap-select form-control" style="border: 1px solid #ced4da !important; border-radius: 4px !important;">
                                        <select class="form-control selectpicker" data-live-search="true" name="id_usuario_recibe_reg" id="input-select-usuario">
                                            <option>Selecciona</option>
                                            <?php foreach ($usuario2 as $fila2) : ?>
                                                <option value="<?php echo $fila2['identificacion']; ?>"><?php echo $fila2['identificacion']. ' - ' . $fila2['nombre']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre_usuario_entrega" placeholder="Nombre del usuario quien estrega">
                                </div>
                                
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Placa</label>
                                    <input type="text" class="form-control" name="placa_equipo" placeholder="Placa del equipo">
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre_usuario_recibe" placeholder="Nombre del usuario que recibe">
                                </div>
                                
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Dependencia</label>
                                    <input type="text" class="form-control" name="dependencia_usuario_entrega" placeholder="Dependencia del usuario quien estrega">
                                </div>
                                
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Serial</label>
                                    <input type="text" class="form-control" name="serial_equipo" placeholder="Serial del equipo">
                                </div>

                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Dependencia</label>
                                    <input type="text" class="form-control" name="dependencia_usuario_recibe" placeholder="Dependencia del usuario que recibe">
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Sede</label>
                                    <input type="text" class="form-control" name="sede_usuario_entrega" placeholder="Sede del usuario quien estrega">
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion_equipo" placeholder="Descripción del equipo">
                                </div>
                                
                                <div class="form-group col-md-4 mt-3">
                                    <label class="control-label">Sede</label>
                                    <input type="text" class="form-control" name="sede_usuario_recibe" placeholder="Sede del usuario que recibe">
                                </div> -->
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
<script>
    function cargarEquipos() {
        var usuarioSeleccionado = document.getElementById("input-select-usuario-entrega").value;
        $.ajax({
            type: "POST",
            url: "<?php echo SERVERURL; ?>ajax/cargarEquipos.php",
            data: { usuario: usuarioSeleccionado },
            success: function(response) {
                $("#input-select-equipo").html(response);
                $(".selectpicker").selectpicker("refresh"); // Actualiza el selectpicker después de cambiar el contenido
            }
        });
    }
</script>






