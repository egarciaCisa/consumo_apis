<?php





  
?>

<div class="content-wrapper" style="min-height: 717px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 id="tiempo">Consulta de api <?php echo $nombre_tyrecheck?></h1>

          <div id="countdown2"></div>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Registros</li>

          </ol>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-12">

          <div class="card card-info card-outline">

            <div class="card-header">

            <div class='countdown' reset="<?php echo $fechaCountdown_Tyrecheck["setTime"]; ?>"></div>

            </div>

            <div class="card-body">
              
              <table class="table table-bordered table-striped dt-responsive tablaAautentificacion" width="100%">
                
                <thead>
                  
                  <tr>
                    
                    <th style="width:10px">#</th>
                    <th>Nombre de la Api</th>
                    <th>Token</th>
                    <th>Estado</th>
                    <th>Fecha Final</th>
                    <th>DataJson</th>
                  </tr>

                </thead>

                <tbody>
                  
                 <!--  <tr>
                    
                    <td>1</td>
                    <td>Hotel Portobelo</td>
                    <td>portobelo</td>
                    <td>Administrador</td>
                    <td><button class="btn btn-info btn-sm">Activo</button></td>
                    <td>

                      <div class='btn-group'>
                      
                        <button class="btn btn-warning btn-sm">
                          <i class="fas fa-pencil-alt text-white"></i>
                        </button>  

                        <button class="btn btn-danger btn-sm">
                          <i class="fas fa-trash-alt"></i>
                        </button> 

                      </div> 

                    </td>

                  </tr> -->

                </tbody>

              </table>

            </div>


            <div class="card-footer">
       
            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

</div>



