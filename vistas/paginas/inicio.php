<?php





  
?>

<div class="content-wrapper" style="min-height: 717px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 id="tiempo">Consumo de Apis CISA</h1>

          <div id="countdown2"></div>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

          </ol>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-sm-12 col-md-4">

          <div class="mb-3">
              <button class="btn btn-primary btn-lg btn-block" type="button" data-toggle="modal" data-target="#crearConsultaApi">Registrar nueva Api</button>
              <div class="col-12">
              <ol class="list-group list-group-numbered pt-3">
                   <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold"><b>Consultas</b></div>
                        Consulta de Api: <?php echo $nombre_tyrecheck?>
                        </div>
                        <span class="badge bg-primary rounded-pill">Cosula: <?php echo $ultimoRegistro_Tyrecheck?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold"><b>Consultas</b></div>
                        Consulta de Api: <?php echo $nombre_cloudcore?>
                        </div>
                        <span class="badge bg-primary rounded-pill">Cosula: <?php echo $ultimoRegistro_Cloudcore?></span>
                    </li>
                  </ol>
              </div>
          </div>

        </div>

        <div class="col-sm-12 col-md-8">

                <?php

                    foreach ($controlador as $key => $value) {


                      echo '<div class=" card card-info mb-3">

                          <div class="card-header">

                          <h3 class="card-title">Controlador</h3>

                          <button type="button" class="btn btn-tool float-right" data-widget="collapse"><i class="fas fa-minus"></i></button>

                          </div>

                          <div class="card-body">';


                      echo '<form>
                        
                          <div class="">

                              <!-- input nombre api-->

                              <h5 class="card-title mb-3"><b>Nombre de la Api</b></h5>
                              
                              <div class="input-group mb-3">
                              
                              <div class="input-group-append input-group-text">
                                  
                                  <span class="fas fa-pencil-ruler pr-3"></span><b class="pr-3">Nombre de la Api: </b>

                              </div>

                              <input type="text" class="form-control" id="registroNombre" value="'.$value["nombreApi"].'" >   

                              </div>

                              <h5 class="card-title mb-3"><b>Consulta GET</b></h5>

                              <div class="clearfix"></div>

                              <!-- input fechas -->

                              div.flex-

                              <div class="col-6">

                                <div class="input-group mb-3 ">
                                
                                  <div class="input-group-append input-group-text">
                                      
                                    <span class="fas fa-calendar-day pr-3"></span><b class="pr-3">Fecha Inicio: </b>

                                  </div>

                                  <input type="text" class="form-control" name="fechaActual" value="'.$value["fechaInicio"].'" >   

                                </div>

                                <!-- input fecha -->

                                <div class="input-group mb-3 ">
                                
                                  <div class="input-group-append input-group-text">
                                      
                                      <span class="fas fa-calendar-day pr-3"></span><b class="pr-3">Fecha Final: </b>

                                  </div>

                                  <input type="text" class="form-control" name="registroPassword" value="'.$value["fechaFinal"].'" disabled>   

                                </div>
                              
                              </div>

                              <div class="col-6">

                                <!-- input consulta -->

                                <div class="input-group mb-3">

                                  <div class="input-group-append input-group-text">
                                      
                                      <span class="	fas fa-calendar-check pr-3"></span><b class="pr-3">Consulta: </b>
                                  
                                  </div>

                                

                                  <select class="form-control"  id="fechaFinal"  required>

                                      <option value="1">Consultar por día</option>

                                      <option value="2">Consultar por 2 días</option>

                                      <option value="7">Consultar por 7 días</option>

                                      <option value="10">Consultar por 10 días</option>

                                      <option value="30">Consultar por 30 días</option>

                                  </select> 

                                </div>
                              
                              </div>

                              

                              

                              

                              <h5 class="card-title mb-3"><b>Recargar Sistema</b></h5>

                              <!-- input fecha -->

                              <div class="input-group mb-3">
                              
                                <div class="input-group-append input-group-text">
                                    
                                    <span class="fas fa-recycle pr-3"></span><b class="pr-3">Hora reset: </b>

                                </div>

                                <input type="text" class="form-control" value="'.$value["setTime"].'" disabled>   

                              </div>


                              <!-- input set interval -->

                              <div class="input-group mb-3">

                                  <div class="input-group-append input-group-text">
                                  
                                  <span class="	fas fa-clock pr-3"></span><b class="pr-3">Resetear: </b>

                                  </div>

                                    <select class="form-control"  id="setTime" required>

                                    <option value="1">Recharge por día</option>

                                    <option value="7">Recharge por semana</option>

                                    <option value="30">Recharge por mes</option>
                                  
                                  </select> 

                              </div>

                              <!-- seleccionar paginacion -->

                              

                              <div class="input-group mb-3">

                                <div class="col-7">

                                  <h5 class="card-title mb-3"><b>Paginación</b></h5>';

                                  if($value["paginas"] == 1){

                                    echo '<fieldset class="row mb-3">
                          
                                              <div class="col-sm-10">
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="paginas" id="paginas" value="0">
                                                  <label class="form-check-label" for="gridRadios1">
                                                  Desactivado
                                                  </label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="paginas" id="paginas" value="1" checked>
                                                  <label class="form-check-label" for="gridRadios2">
                                                  Activado
                                                  </label>
                                              </div>
                                              
                                              </div>
                                          </fieldset>
                                          
                                          <select class="form-control mb-3"  disabled>

                                              <option value="1">De la pagína 1</option>

                                          </select>
                                          
                                          <select class="form-control" name="paginaFinal" disabled>';

                                            for ($i=2; $i < 20; $i++) { 
                                              echo '<option value="'.$i.'">A la pagína '.$i.'</option>';
                                            }

                                          echo'</select> ';

                                  }else{

                                    echo '<fieldset class="row mb-3">
                          
                                              <div class="col-sm-10">
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="paginas" id="paginas" value="0" checked>
                                                  <label class="form-check-label" for="gridRadios1">
                                                  Desactivado
                                                  </label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="paginas" id="paginas" value="1">
                                                  <label class="form-check-label" for="gridRadios2">
                                                  Activado
                                                  </label>
                                              </div>
                                              
                                              </div>
                                          </fieldset>
                                          
                                          <select class="form-control mb-3"  disabled>

                                              <option value="1">De la pagína 1</option>

                                          </select>
                                          
                                          <select class="form-control"  disabled>

                                            <option value="2">A la pagína 2</option>

                                          </select>';

                                  }


                                echo '</div>
                              
                              </div>


                          </div>

                      </form>';


                      echo '</div>


                          <div class="card-footer">
          
                            <div>
                              <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
          
                  
                          </div>
          
                      </div>';

                      
                    }

                    

                ?>


                    
                
            

                

            

        </div>

      </div>

    </div>

  </section>

</div>



<!--=====================================
Modal Crear Administrador
======================================-->

<div class="modal" id="crearConsultaApi">

  <div class="modal-dialog">
    
    <div class="modal-content">

    <form method="post">
      
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear consulta de Api</h4>

           <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

          <!-- input nombre api-->
          
          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-pencil-ruler"></span>

            </div>

            <input type="text" class="form-control" name="nombreApi" placeholder="Nombre de la api" required>   

          </div>

          

           <!-- input fechas -->

          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-calendar-day"></span>

            </div>

            <input type="text" class="form-control" name="fechaInicio" value="<?php echo substr(date('Y-m-d H:i:s', strtotime($fechaActual.' - 1 days')),0,-9) ?>" required>   
            <input type="hidden" class="form-control" name="fechaActual" value="<?php echo substr($fechaActual,0,-9) ?>" >   

          </div>

          <!-- input consulta -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              
              <span class="	fas fa-calendar-check"></span>
            
            </div>

            <select class="form-control" name="consulta"  required>

              <option value="1">Consulta por 1 día</option>

              <option value="0">Consulta por mes</option>

            </select> 

          </div>


          <!-- input set interval -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              
              <span class="	fas fa-clock"></span>
            
            </div>

            <select class="form-control" name="setInterval" required>

              <option value="1">Resetear por 1 día</option>

              <option value="7">Resetear por 7 días</option>

              <option value="15">Resetear por 15 días</option>

              <option value="30">Resetear por 30 días</option>

            </select> 

          </div>

          <!-- input fecha 

          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-calendar-day"></span>

            </div>

            <input type="password" class="form-control" name="registroPassword" placeholder="<?php echo $fechaActual ?>" disabled>   

          </div>-->

           <!-- seleccionar paginacion -->

          

           <div class="input-group mb-3">

            <div class="col-7">

            <h5 class="card-title mb-3"><b>Paginación</b></h5>


            <fieldset class="row mb-3">
    
                <div class="col-sm-10">

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paginas" id="activar" value="1" checked>
                    <label class="form-check-label" for="gridRadios2">
                    Activado
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paginas" id="desactivado" value="0">
                    <label class="form-check-label" for="gridRadios1">
                    Desactivado
                    </label>
                </div>
                
                
                </div>
            </fieldset>
            
            <select class="form-control mb-3" name="paginaInicio" disabled>

              <option value="1">De la pagína 1</option>

            </select>

            <select class="form-control" name="paginaFinal">

                <option value="100">a la pagína 100</option>

                <option value="1000">a la pagína 1000</option>

                <option value="10000">a la pagína 10000</option>

              

            </select> 
            </div>
           
           </div>


           

           

           <?php 

             $registroAdministrador = new ControladorInicio();
             $registroAdministrador -> ctrRegistroControladoresApi();

           ?>

        </div>

        <div class="modal-footer d-flex justify-content-between">
          
          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
             <button type="submit" class="btn btn-primary">Guardar</button>
          </div>

        </div>

    </form>

    </div>

  </div>

</div>



