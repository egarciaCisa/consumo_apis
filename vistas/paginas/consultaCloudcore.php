<div class="content-wrapper" style="min-height: 717px;">
<?php 

if(isset($_GET["id"])){

  $consultaCloudcore = ControladorCloudcore::ctrConsultaCloudcoreDataJoson(null,null);

  echo '<section class="content-header">

            <div class="container-fluid">

              <div class="row mb-2">

                <div class="col-sm-6">

                <h1>Consulta '.$nombre_cloudcore.'</h1>

                </div>

                <div class="col-sm-6">

                  <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Consulta</li>

                  </ol>

                </div>

              </div>

            </div><!-- /.container-fluid -->

          </section>

          <section class="content">

            <div class="container-fluid">

              <div class="row">

                <div class="col-md-12">
              
                  <div class="card card-info">
        
                    <div class="card-header">
                      <h3 class="card-title">Consulta del día: // '.date('Y-m-d', strtotime($fechaBaseDatos_Tyrecheck["fecha"].'- 1 days')).'// al día: // '.substr($fechaBaseDatos_Tyrecheck["fecha"],0,-8).' //</h3>
                    </div>

                  </div>
      
                  <div class="card-body">

                    <div class="col-12">

                      <div class="card card-info card-outline">

                        <div class="card-header">';


                        $sumaCloudcore = ControladorCloudcore::ctrConsultaCloudcore(null,null);

        


                      echo'<h6><strong>Consultas Totales:</strong> '.count($consultaCloudcore).'</h6>
                          <h6><strong>Registro Total: :</strong> '.count($sumaCloudcore).' registros</h6>

                        </div>

                        <div class="card-body">

                          <table class="table table-bordered table-striped dt-responsive " width="100%">

                            <thead>
                
                              <tr>
                                
                                <th style="width:10px">#</th>
                                <th>invoiceId</th>
                                <th>issuer</th>
                                <th>issuerRfc</th>
                                <th>receiverRfc</th>
                                <th>issueDate</th>  
                                <th>XML</th> 


                              </tr>

                            </thead>


                            ';


                            foreach ($sumaCloudcore as $key => $value1) {


                              if($value1["id_consulta"] == $_GET["id"]){

                                echo '
                                <tbody>
                                  <tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$value1["invoiceId"].'</td>
                                    <td>'.$value1["issuer"].'</td>
                                    <td>'.$value1["issuerRfc"].'</td>
                                    <td>'.$value1["receiverRfc"].'registros</td>
                                    <td>'.$value1["issueDate"].'</td>
                                    <td>
                  
                                      <div class="btn-group">
                                      
                                        <button data-toggle="modal" data-target="#modalConsultaApi" class="btn btn-primary btn-sm btnConsultar" token="'.$value1["url"].'" fullNumber="'.$value1["url"].'">
                                          <i class="far fa-file-code text-white"></i> Ver XML
                                        </button>  
                  
                                        
                  
                                      </div> 
                  
                                    </td>
                                  </tr>
                                </tbody>';

                              }else{

                                if($value1["id"] == 1){

                                  echo '<div class="jumbotron text-center">
                                      <h1 style="color:black;font-size:100px"><i class="fas fa-ban"></i></h1>
                                      <h1>Error 401</h1>
                                      <p>El cliente no posee los permisos necesarios</p>
                                  </div>';

                                }

                                

                              }
                                        
                              
                              
                            }






                            echo ' </table>

                        </div>

                      </div>

                    </div>

                  </div>
      
              </div>
            
            </div>

          </section>
          ';

  //var_dump($consultaTyrecheck);
}else{

  echo '<section class="content-header">

            <div class="container-fluid">

              <div class="row mb-2">

                <div class="col-sm-6">

                </div>

                <div class="col-sm-6">

                  <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Consulta</li>

                  </ol>

                </div>

              </div>

            </div><!-- /.container-fluid -->

          </section>

          <section class="content">

            <div class="container-fluid">

              <div class="row">

                <div class="col-md-12">
              
                  <div class="card card-info">
        
                    <div class="card-header">
                      <h3 class="card-title">Consulta del día: // </h3>
                    </div>

                  </div>
      
                  <div class="card-body">

                    <div class="col-12">

                      <div class="card card-info card-outline">

                        <div class="card-header">';


                          echo'<h6><strong>Estatus:</strong> 400</h6>
                          <h6><strong>Registro:</strong> 0</h6>
                          <h6><strong>Total de registros :</strong> 0 Measurements</h6>
                          <h6><strong>Total de registros :</strong> 0 Observations</h6>

                        </div>

                        <div class="card-body">

                          <table class="table table-bordered table-striped dt-responsive " width="100%">

                            <thead>
                
                              <tr>
                                
                                <th style="width:10px">#</th>
                                <th>Id Api</th>
                                <th>Servicio</th>
                                <th>Measurements</th>
                                <th>Observations</th>
                                <th>Empresa</th> 
                                <th>Acción</th> 


                              </tr>

                            </thead>


                            <tbody>';


                            echo '<div class="jumbotron text-center">
                                      <h1 style="color:black;font-size:50px"><i class="fas fa-skull-crossbones"></i></h1>
                                      <h1>Error 401</h1>
                                      <p>El cliente no posee los permisos necesarios</p>
                                  </div>';

                            echo '</tbody>



                          </table>

                        </div>

                      </div>

                    </div>

                  </div>
      
              </div>
            
            </div>

          </section>
          ';
  
}



?>





  

 

</div>






