<style>
  .sidebar-nav-wrapper {
    background-color: #dbe5d0;
    /* Otros estilos */
  }
  .logo{
  height: 6em;
  
}
</style>
<aside class="sidebar-nav-wrapper">
  <div class="navbar-logo">
    <img class="logo" src="<?php echo SERVERURL; ?>vistas/img/Logo_fondo.png" />
  </div>
  <nav class="sidebar-nav">
    <ul>
      <div class="text-center">
        <b><span class="logo_name text-center"></span></b>
      </div>
      <li class="nav-item nav-item-has-children">
        <a href="" class="dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-house-door lead px-2 iconos-color"></i>
          <span class="text">Home</span>
        </a>
        <ul id="ddmenu_1" class="collapse show dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL; ?>home/" class="active">Principal</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_45" aria-controls="ddmenu_45" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-people px-2 iconos-color"></i>
          <span class="text">Usuario</span>
        </a>
        <ul id="ddmenu_45" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>usuario-nuevo/">Crear Usuario</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>usuario-lista/">Lista de Usuarios</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>buscar-usuario/">Buscar Usuario</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_46" aria-controls="ddmenu_46" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-laptop px-2 iconos-color"></i>
          <span class="text">Equipo</span>
        </a>
        <ul id="ddmenu_46" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>agregar-equipos/">Agregar Equipo</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>lista-equipo/">Lista de Equipos</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>buscar-equipo/">Buscar Equipos</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_entrega" aria-controls="ddmenu_entrega" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-archive px-2 iconos-color"></i>
          <span class="text">Entregas</span>
        </a>
        <ul id="ddmenu_entrega" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>entrega-equipos/">Agregar Entrega de Equipos</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>lista-entregados/">Lista de Equipos Entregados</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>buscar-entregados/">Buscar Equipos Entregados</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_devoluciones" aria-controls="ddmenu_devoluciones" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-arrow-left-right px-2 iconos-color"></i>
          <span class="text">Devoluciones</span>
        </a>
        <ul id="ddmenu_devoluciones" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>agregar-devoluciones/">Agregar Equipos Devueltos</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>lista-devoluciones/">Lista de Equipos Devueltos</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>buscar-devoluciones/">Buscar Equipos Devueltos</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_traspaso" aria-controls="ddmenu_traspaso" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-arrow-right-short px-2 iconos-color"></i>
          <span class="text">Traspaso</span>
        </a>
        <ul id="ddmenu_traspaso" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>agregar-traspaso/">Agregar Traspaso</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>lista-traspaso/">Lista de Equipos Traspasados</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>buscar-traspaso/">Buscar Traspaso</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_soporte" aria-controls="ddmenu_soporte" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-gear-wide-connected px-2 iconos-color"></i>
          <span class="text">Soporte Tecnico</span>
        </a>
        <ul id="ddmenu_soporte" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>soporte-equipos/">Agregar Soporte Técnico</a>
          </li>
        </ul>
      </li>
      <span class="divider">
      <hr />
      </span>
      <li class="nav-item">
        <a href=" <?php echo SERVERURL; ?>login/" class="exit-system-cerrar">
          <i class="bi bi-box-arrow-left lead px-2 iconos-color" data-bs-toggle="tooltip" data-bs-placement="right" title="Reportes"></i>
          <span class="text">Cerrar sesión</span>
        </a>
      </li>
    </ul>
  </nav>
</aside>
<div class="overlay"></div>
