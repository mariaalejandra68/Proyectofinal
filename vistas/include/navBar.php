<style>
  .header {
  background-color: #b4e4b4;
  /* Otros estilos */
}
</style>
<?php //include "Proyectofinal\controladores\loginControlador.php";?>
<header class="header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-6">
        <div class="header-left d-flex align-items-center">
          <div class="menu-toggle-btn mr-20">
            <?php if($_SESSION['id_tipo_usu_spc'] == '1' && $_SESSION['id_tipo_usu_spc'] == '1'){?>
            <button id="menu-toggle" class="main-btn primary-btn btn-hover">
              <i class="bi bi-list-ul lead"></i>
              </button>
              <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-md-7 col-6">
        <div class="header-right">
          
          <!-- profil -->
          <div class="profile-box ml-15">
            <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="profile-info">
                <div class="info">
                  <div class="image">
                    <img src="<?php echo SERVERURL; ?>vistas/img/Logo_fondo.png" />
                    <span class="status"></span>
                  </div>
                </div>
              </div>
              <i class="lni lni-chevron-down"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
              <li>
                <a href="<?php echo SERVERURL; ?>perfil/"><i class="lni lni-user"></i>Mi perfil</a>
              </li>
              <li>
                <a href="<?php echo SERVERURL; ?>pass-update/"><i class="lni lni-user"></i>Cambiar contraseña</a>
              </li>
              <li>
              <a href="" id="cerrar-sesion-btn" class="btn-exit-system2"><i class="lni lni-exit"></i>Cerrar sesion</a>
              </li>
            </ul>
          </div>
          <!-- profile fin -->
        </div>
      </div>
    </div>
  </div>
</header>

<!-- ==========  fin ========== -->