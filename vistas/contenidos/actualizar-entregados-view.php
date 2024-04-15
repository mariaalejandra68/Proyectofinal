<?php
include "./modelos/entregaModelo.php";
$reg_equipo = new entregaModelo();
$usuario = $reg_equipo->listar_usuario();
$equipo = $reg_equipo->listar_equipos();
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
                                    <a href="#">Entregados</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo SERVERURL; ?>lista-entregados/">Lista de Equipos Entregados</a>
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
                            require_once "./controladores/entregaControlador.php";
                            $reg_entrega = new entregaControlador();

                            $datos_entrega = $reg_entrega->datos_entrega_controladores($pagina[1]);

                            if ($datos_entrega->rowCount() == 1) {
                                $campos = $datos_entrega->fetch();
                            ?>
                                <form class="mt-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/entregaAjax.php" method="POST" data-form="update" autocomplete="off">
                                    <input type="hidden" name="entrega_up" value="<?php echo $pagina[1]; ?>">
                                    <div class="row mt-4">
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">ID Entrega</label>
                                            <input class="form-control" maxlength="10" type="text" name="id_entrega_up" value="<?php echo $campos['id_entrega']; ?>" pattern="[0-9-]{4,10}" require>
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Fecha Entrega</label>
                                            <input class="form-control" maxlength="30" type="date" name="fecha_entrega_up" value="<?php echo $campos['fecha_entrega']; ?>" require>
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Ciudad Entrega </label>
                                            <input class="form-control" maxlength="30" type="text" name="ciudad_entrega_up" value="<?php echo $campos['ciudad_entrega']; ?>" require>
                                        </div>
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Codigo tic Sena</label>
                                            <input class="form-control" maxlength="10" type="text" name="codigo_tic_sena_up" value="<?php echo $campos['codigo_tic_sena']; ?>" pattern="[0-9-]{2,10}" require>
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Codigo Sitio</label>
                                            <input class="form-control" maxlength="30" type="text" name="codigo_sitio_up" value="<?php echo $campos['codigo_sitio']; ?>" pattern="[0-9-]{2,10}" require>
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Nombre Representante</label>
                                            <input class="form-control" maxlength="30" type="text" name="nombre_representante_up" value="<?php echo $campos['nombre_representante']; ?>" require>
                                        </div>
                                        <div class="form-group col-md-4 mt-3">
                                            <label class="control-label">Documento Representante</label>
                                            <input class="form-control" maxlength="10" type="text" name="documento_representante_up" value="<?php echo $campos['documento_representante']; ?>" pattern="[0-9-]{2,10}" require>
                                        </div>
                                    
                                        <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Usuarios</label>
                                        <div class="dropdown bootstrap-select form-control" style="border: 1px solid #ced4da !important; border-radius: 4px !important;">
                                            <select class="form-control selectpicker" data-live-search="true" name="id_usuario_up" id="input-select-usuario">
                                                <option><?php echo $campos['id_usuario']; ?></option>
                                                <?php foreach ($usuario as $fila) : ?>
                                                    <option value="<?php echo $fila['identificacion']; ?>"><?php echo $fila['identificacion']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        </div>
                                   

                                        <div class="form-group col-md-4 mt-3">
                                        <label class="control-label">Equipos</label>
                                        <div class="dropdown bootstrap-select form-control" style="border: 1px solid #ced4da !important; border-radius: 4px !important;">
                                            <select class="form-control selectpicker" data-live-search="true" name="id_equipo_up" id="input-select-equipo">
                                                <option><?php echo $campos['id_equipo']; ?></option>
                                                <?php foreach ($equipo as $fila) : ?>
                                                    <option value="<?php echo $fila['n_placa']; ?>"><?php echo $fila['n_placa']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
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