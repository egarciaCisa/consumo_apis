<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!--=====================================
  LOGO
  ======================================-->
  <a href="<?php echo $htacces?>administradores" class="brand-link">
  
    <img src="vistas/img/plantilla/icono.jpg" class="brand-image img-circle elevation-3" style="">

    <span class="brand-text font-weight-light"><b>Consulta de Apis</b></span>

  </a>

  <!--=====================================
  MENÚ
  ======================================-->

  <div class="sidebar">

    <nav class="mt-2">
      
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php if ($admin["perfil"] == "Administrador"): ?>

        <!-- Botón página administradores -->
  
          <li class="nav-item">

            <a href="<?php echo $htacces?>administradores" class="nav-link">

              <i class="nav-icon fas fa-users-cog"></i>

              <p>Administradores</p>

            </a>

          </li>

        <?php endif ?>

        <li class="nav-item">
          <a href="<?php echo $htacces?>inicio" class="nav-link">
          <i class="nav-icon fab fas fa-pencil-ruler"></i>
            <p>
              Registro consultas
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="<?php echo $htacces?>tyrecheck" class="nav-link">
          <i class="nav-icon fab fa-get-pocket"></i>
            <p>
              Api <?php echo $nombre_tyrecheck?>
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo $htacces?>cloudcore" class="nav-link">
          <i class="nav-icon fab fa-get-pocket"></i>
            <p>
              Api <?php echo $nombre_cloudcore?>
            </p>
          </a>
        </li>


        

        

      </ul>

    </nav>
  
  </div>

</aside>