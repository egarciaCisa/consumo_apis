<div class="content-wrapper" style="min-height: 717px;">
<?php 

if(isset($_GET["id"])){

  $consultaTyrecheck = ControladorTyrecheck::ctrConsultaTyrechekDataJoson(null,null);

  echo '<section class="content-header">

            <div class="container-fluid">

              <div class="row mb-2">

                <div class="col-sm-6">

                <h1>Consulta '.$nombre_tyrecheck.'</h1>

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
              
                  <div class="card-body">

                    <div class="col-12">

                      <div class="card card-info card-outline">

                        <div class="card-header">

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


                            ';


                            foreach ($consultaTyrecheck as $key => $value1) {

                              if($value1["id_consulta"] == $_GET["id"]){

                                echo '
                                <tbody>
                                  <tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$value1["id_api"].'</td>
                                    <td>'.$value1["ServiceProviderCode"].'</td>
                                    <td>('.count(json_decode($value1["Measurements"])).') registros</td>
                                    <td>('.count(json_decode($value1["Observations"])).') registros</td>
                                    <td>'.$value1["ServiceCenterCode"].'</td>
                                    <td>
                  
                                      <div class="btn-group">
                                      
                                        <button data-toggle="modal" data-target="#modalConsultaApi" class="btn btn-success btn-sm btnConsultar" token="'.$value1["id_api"].'" fullNumber="'.$value1["id_api"].'">
                                          <i class="fas fa-eye text-white"></i> Ver conslta
                                        </button>  
                  
                                        
                  
                                      </div> 
                  
                                    </td>
                                  </tr>
                                </tbody>';

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
}


?>





  

 

</div>






