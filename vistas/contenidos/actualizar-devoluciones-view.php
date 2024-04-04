<?php
include "./modelos/devolucionesModelo.php";
$reg_equipo = new devolucionesModelo();
$usuario = $reg_equipo->listar_usuario();
$equipo = $reg_equipo->listar_equipos();
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
                        <h2></h2>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Equipos</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo SERVERURL; ?>lista-devoluciones/">Lista de Equipos Devueltos</a>
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
                            require_once "./controladores/devolucionesControlador.php";
                            $reg_devoluciones = new devolucionesControlador();

                            $datos_devoluciones = $reg_devoluciones->datos_devoluciones_controladores($pagina[1]);

                            if ($datos_devoluciones->rowCount() == 1) {
                                $campos = $datos_devoluciones->fetch();
                            ?>
                                <form class="mt-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/devolucionesAjax.php" method="POST" data-form="update" autocomplete="off">
                                    <input type="hidden" name="devoluciones_up" value="<?php echo $pagina[1]; ?>">
                                    <div class="row mt-4">
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">ID Devolucion</label>
                                            <input class="form-control" maxlength="10" type="text" name="id_devolucion_up" value="<?php echo $campos['id_devolucion']; ?>" pattern="[0-9-]{4,10}" require>
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Fecha Devolucion</label>
                                            <input class="form-control" maxlength="30" type="date" name="fecha_devolucion_up" value="<?php echo $campos['fecha_devolucion']; ?>" require>
                                        </div>

                                    </div>

                                    <div class="form-group col-md-4 mt-3">
                                            <label class="form-label">Usuario</label>
                                            <select class="form-control" name="id_usuario_up">
                                                <option>Selecciona</option>
                                                <?php foreach ($usuario as $fila) : ?>
                                                    <option value="<?php echo $fila['identificacion']; ?>" <?php if ($campos['id_usuario'] == $fila['identificacion']) {
                                                        echo 'selected=""';} ?>><?php echo $fila['identificacion'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    <div class="row">
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="form-label">equipo</label>
                                            <select class="form-control" name="id_equipo_up">
                                                <option>Selecciona</option>
                                                <?php foreach ($equipo as $fila) : ?>
                                                    <option value="<?php echo $fila['n_placa']; ?>" <?php if ($campos['id_equipo'] == $fila['n_placa']) {
                                                        echo 'selected=""';} ?>><?php echo $fila['n_placa'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mt-3">
                                            <label class="form-label">Soporte Tecnico</label>
                                            <select class="form-control" name="id_soporte_up">
                                                <option>Selecciona</option>
                                                <?php foreach ($soporte as $fila) : ?>
                                                    <option value="<?php echo $fila['identificacion']; ?>" <?php if ($campos['id_soporte'] == $fila['identificacion']) {
                                                        echo 'selected=""';} ?>><?php echo $fila['identificacion'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                     </div>
                                     <div class="row">
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="form-label">Disponibilidad</label>
                                            <select class="form-control" name="id_disponibilidad_up">
                                                <option>Selecciona</option>
                                                <?php foreach ($disponibilidad as $fila) : ?>
                                                    <option value="<?php echo $fila['id_disponibilidad']; ?>" <?php if ($campos['id_disponibilidad'] == $fila['id_disponibilidad']) {
                                                        echo 'selected=""';} ?>><?php echo $fila['disponibilidad'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Observaciones </label>
                                            <input class="form-control" maxlength="30" type="text" name="observaciones_up" value="<?php echo $campos['observaciones']; ?>" require>
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