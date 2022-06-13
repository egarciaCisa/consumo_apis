<body class="hold-transition login-page">

  <div class="login-box">

    <div class="login-logo">

      
    
    </div>
    <!-- /.login-logo -->

    <div class="card">

      <div class="card-body login-card-body">

        <center><img src="vistas/img/plantilla/logo.png" class="" style=""></center>

        <form method="post">

          <div class="input-group mb-3">

            <input type="text" class="form-control" placeholder="Usuario" name="ingresoUsuario">

            <div class="input-group-append">

              <div class="input-group-text">

                <span class="fas fa-envelope"></span>

              </div>

            </div>

          </div>

          <div class="input-group mb-3">

            <input type="password" class="form-control" placeholder="Password" name="ingresoPassword">

            <div class="input-group-append">

              <div class="input-group-text">

                <span class="fas fa-lock"></span>

              </div>

            </div>

          </div>        

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button> 

          <?php

          $ingreso = new ControladorAdministradores();
          $ingreso -> ctrIngresoAdministradores(); 


          ?>   
   
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>

  </div>
  <!-- /.login-box -->

</body>