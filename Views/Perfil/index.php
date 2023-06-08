<?php
headerAdmin($data);
?>



<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><?php echo $data['page_name']; ?></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="">
              <div class="col-md-10 col-sm-10  ">
                <div class="x_panel">
                  <div class="x_content">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Perfil</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Ayuda</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="bs-example" data-example-id="simple-jumbotron">
                          <div class="jumbotron">
                            <center>
                              <h1>¡Hola! <?php echo $_SESSION['nombre']; ?></h1>
                              <p1>Bienvenido a SCD (Sistema Control de Seguridad).<br>
                                Te brindamos diferentes herramientas para que puedas desempeñar tus actividades de una manera facil y senciila esperando
                                disminuir tiempo entre procesos y evitar redundancia de informacion.</p1>
                            </center>
                          </div>
                        </div>

                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col-md-3   widget widget_tally_box">
                          <div class="x_panel fixed_height_390">
                            <div class="x_content">
                              <div class="flex">
                                <ul class="list-inline widget_profile_box">
                                  <li>
                                    <a>
                                      <i class="fa fa-facebook"></i>
                                    </a>
                                  </li>
                                  <li>
                                    <img src="Imagenes/default.png" alt="..." class="img-circle profile_img">
                                  </li>
                                  <li>
                                    <a>
                                      <i class="fa fa-twitter"></i>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <h3 class="name"><?php echo $_SESSION['nombre']; ?></h3>
                              <div class="flex">
                                <ul class="list-inline count2">

                                  <li>
                                    <center>
                                      <span>Correo:</span>
                                      <span><?php echo $_SESSION['email']; ?></span>
                                    </center>
                                  </li>
                                </ul>
                              </div>
                              <p>
                                If you've decided to go in development mode and tweak all of this a bit, there are few things you should do.
                              </p>
                            </div>
                          </div>
                        </div>






                      </div>
                      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        Para cualquier duda que tengas en cuanto el funcionamiento
                        de este sistema puedes contactarnos por medio de la liga
                        que se encuentra al final de todas las paginas o a los sigueintes
                        correos electronicos que apareceran acontinuacion:<br><br>

                        <center>
                          <a href="mailto:osvaldo.bautista@elektra.com.mx><span class=" text-gray">Soporte tecnico</span></a><br>
                          <a href="mailto:osvaldoagustinbautistagonzalez@gmail.com><span class=" text-gray">Contacto Directo</span></a>
                        </center>



                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>




          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->



<?php footerAdmin($data); ?>