<?php


  
?>

<div class="content-wrapper" style="min-height: 717px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 id="tiempo" style="text-transform: uppercase;">RESGISTROS </h1>

          <?php


          ?>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">INICIO</a></li>
            <li class="breadcrumb-item active">REGISTROS</li>

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

            <div class="card-header flex-center" >
        
              <div class='countdown' reset="<?php echo $fechaCountdown_Tyrecheck["setTime"]; ?>"></div>
              <div class="col-sm-9 pl-3">
                <?php

                    echo'<h6 class="mt-1"><strong>Api:</strong> '.$nombre_tyrecheck.'</h6>
                        <h6 class="mt-1"><strong>Registros Totales:</strong> '.$numTabConsulta_Tyrecheck.'</h6>
                        <h6><strong>Registro Total: :</strong> '.$numTabMesurements_Tyrecheck.' Measurements</h6>
                        <h6><strong>Registro Total :</strong> '.$numTabObservations_Tyrecheck.' Observations</h6>';

                ?>
              </div>

            </div>



            <div class="card-body">
              
              <table class="table table-bordered table-striped dt-responsive tablaAautentificacion" width="100%">
                
                <thead>
                  
                  <tr class="text-center">
                    
                    <th style="width:10px">#</th>
                    <th>Proveedor</th>
                    <th>Respuesta</th>
                    <th>Token</th>
                    <th>Fechas consultadas</th>
                    <th>Registros</th>
                    <th>Consulta</th>
                    <th>Datos JSON</th>
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



