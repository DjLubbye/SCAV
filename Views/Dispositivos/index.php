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
            <ul class="nav navbar-right panel_toolbox">
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php echo Alertas::mostraAlerta(); ?>
            <div class="col-md-7">
              <br>
              <div class="card">
                <div class="card-header">
                  <div style="display: flex; justify-content: center; align-items: center;">
                    <button class="btn btn-dark btn-sm" id="trasera"><i class="fa fa-undo"></i></button>
                    <button class="btn btn-dark btn-sm" id="frontal"><i class="fa fa-barcode"></i></button>
                    <button class="btn btn-dark btn-sm" id="stop"><i class="fa fa-stop"></i></button>
                  </div>
                </div>
                <div class="card-body" style="border-radius: 10px; max-width: 100%;">
                  <div style="position: relative; padding-bottom: 100%; height: 0; overflow: hidden;">
                    <div id="interactive" class="viewport" style="transform: scaleX(-1); position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 10px;"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <br>
              <div class="card">
                <div class="card-header">
                  <center> Datos de Dispositivos</center>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url ?>/dispositivos/store" method="POST" class="form-horizontal 
                        form-label-left" novalidate>
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">
                        <i class="fa fa-calendar fa-2x"></i> <!-- Icono fa-calendar con tamaño mediano -->
                        <span class="required">:</span>
                      </label>
                      <?php
                      date_default_timezone_set("America/Mexico_City");
                      $fcha = date("Y-m-d");
                      ?>
                      <div class="col-md-8 col-sm-4">
                        <input type="date" class="form-control" id="fechatxt" name="fechatxt" required="required" value="<?php echo $fcha ?? '' ?>" readonly>
                        <span aria-hidden="true"></span>
                      </div>
                    </div>


                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">
                        <i class="fa fa-clock-o fa-2x"></i> <!-- Icono fa-clock-o con tamaño mediano -->
                        <span class="required">:</span>
                      </label>
                      <div class="col-md-8 col-sm-4">
                        <input type="text" class="form-control" id="horatxt" name="horatxt" readonly>
                      </div>
                    </div>

                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align"><i class="fa fa-barcode fa-2x"></i><span class="required"> :</span></label>
                      <div class="col-md-8 col-sm-4">
                        <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" required="required" placeholder="Codigo de Barras">
                        <br>
                        <a href="<?= base_url ?>/dispositivos/store" class=""><button class="btn btn-info btn-sm"><i class="fa fa-search"></i> Buscar</button></a>
                        <a href="<?= base_url ?>/dispositivos/nuevo" class=""><button class="btn btn-warning btn-sm"><i class="fa fa-plus-circle"></i> Dispositivo</button></a>

                      </div>
                    </div>







                  </form>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-12">
            <br>
            <div class="card">
              <div class="card-header">
                Accesos de Dispositivos Registrados
              </div>
              <div class="table-responsive">

                <div class="card-body">
                  <table id="table" class="display nowrap table-hover table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Responsable Dispositivo</th>
                        <th>Codigo de Barras</th>
                        <th>Fecha</th>
                        <th>Hora de Acceso</th>
                        <th>Hora de Salida</th>
                        <th>Responsable de Revision</th>
                        <th>Status</th>
                        <th>Salida / Eliminar</th>

                      </tr>
                    </thead>
                    <tfoot>
                      <th>ID</th>
                      <th>Responsable Dispositivo</th>
                      <th>Codigo de Barras</th>
                      <th>Fecha</th>
                      <th>Hora de Acceso</th>
                      <th>Hora de Salida</th>
                      <th>Responsable de Revision</th>
                      <th>Status</th>
                      <th>Salida / Eliminar</th>
                    </tfoot>
                    <tbody>
                      <!--  $visitas viene de QRModel del metodo allvisitas() -->



                      <?php if (empty($visitas)) : ?>
                        <p class="py-3 text-center">¡Aún no se registra ningun dispositivo ingresado ! </p>
                      <?php else : ?>
                        <?php foreach ($visitas as $v) : ?>
                          <tr>
                            <td><?php echo $v->id; ?></td>
                            <td><?php echo $v->responsable_dispositivo; ?></td>
                            <td><?php echo $v->codigo_barras; ?></td>
                            <td><?php echo $v->fecha; ?></td>
                            <td><?php echo $v->hora_entrada; ?></td>
                            <td><?php echo $v->hora_salida; ?></td>
                            <td><?php echo $v->resp_revision; ?></td>
                            <?php if ($v->status) : ?>
                              <td><span class="badge badge-info">ACCESADO</span></td>
                            <?php else : ?>
                              <td><span class="badge badge-danger">FINALIZADO</span></td>
                            <?php endif; ?>
                            <!--BOTONES DE ACCIONES  -->
                            <td>
                              <?php if (!empty($v->hora_salida)) { ?>
                                <button id="vehiculoData" data-id="<?php echo $v->id ?>" data-clave="<?php echo $v->codigo_barras ?>" type="button" class="btn btn-success btn-sm" onclick="registrarSalidaDispositivo(this)" disabled style="background-color: gray;">
                                  <i class="fa fa-send text-white"></i>
                                </button>
                              <?php } else { ?>
                                <button id="vehiculoData" data-id="<?php echo $v->id ?>" data-clave="<?php echo $v->codigo_barras ?>" type="button" class="btn btn-success btn-sm" onclick="registrarSalidaDispositivo(this)">
                                  <i class="fa fa-send text-white"></i>
                                </button>
                              <?php } ?>
                              <button id="accesoData" data-id="<?php echo $v->id ?>" data-clave="<?php echo $v->codigo_barras ?>" type="button" class="btn btn-danger btn-sm" onclick="eliminar(this)">
                                <i class="fa fa-remove text-white"></i>
                              </button>
                            </td>



                          </tr>


                        <?php endforeach; ?>



                      <?php endif; ?>



                    </tbody>
                  </table>
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

<script>
  var scanningEnabled = true; // Bandera para habilitar o deshabilitar el escaneo

  // Configurar Quagga y empezar a escanear
  Quagga.init({
    inputStream: {
      name: "Live",
      type: "LiveStream",
      target: document.querySelector('#interactive')
    },
    decoder: {
      readers: ["ean_reader"]
    }
  }, function(err) {
    if (err) {
      console.log(err);
      return;
    }
    console.log("QuaggaJS inicializado.");
    Quagga.start(); // Iniciar la detección de códigos de barras
  });

  // Evento de detección de código de barras
  Quagga.onDetected(function(codigo_barras) {
    if (scanningEnabled) {
      scanningEnabled = false; // Deshabilitar el escaneo para evitar múltiples detecciones

      var code = codigo_barras.codeResult.code;
      console.log("Código de barras detectado: " + code);
      document.getElementById("codigo_barras").value = code; // Asignar el código de barras al elemento con id "codigo_barras"

      // Enviar el formulario automáticamente
      document.forms[0].submit();
      Quagga.stop(); // Detener la detección de códigos de barras después de encontrar uno


      // Mostrar mensaje de alerta
    }
  });
  var clockInput = document.getElementById('horatxt');

  function updateClock() {
    var now = new Date();

    // Obtiene la hora en formato de 12 horas
    var hours = now.getHours();
    var amOrPm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;

    // Formatea la hora como hh:mm:ss AM/PM
    var timeString = hours.toString().padStart(2, '0') + ':' +
      now.getMinutes().toString().padStart(2, '0') + ':' +
      now.getSeconds().toString().padStart(2, '0') + ' ' + amOrPm;

    // Actualiza el valor del input con la hora actual
    clockInput.value = timeString;
  }

  setInterval(updateClock, 1000);
</script>



<?php footerAdmin($data); ?>