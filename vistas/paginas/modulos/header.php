<?php 



?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">

  <!--=====================================
  Botón que colapsa el menú lateral
  ======================================--> 

  <ul class="navbar-nav">

    <li class="nav-item">
      
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    
    </li>

    <li class="nav-item d-none d-sm-inline-block">

      <a class="nav-link">Hola <?php echo $admin["nombre"]; ?></a>

    </li>

  </ul>


  <ul class="navbar-nav ml-auto">

    

    <!--=====================================
    Botón salir del sistema
    ======================================--> 

    <li class="nav-item">

      <a class="nav-link" href="salir">

        <i class="fas fa-sign-out-alt"></i>

      </a>   

    </li>

  </ul>

</nav>