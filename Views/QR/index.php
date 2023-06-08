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
                                        <button class="btn btn-dark btn-sm" id="frontal"><i class="fa fa-camera"></i></button>
                                        <button class="btn btn-dark btn-sm" id="stop"><i class="fa fa-stop"></i></button>
                                    </div>



                                </div>
                                <div class="card-body">

                                    <video id="preview" width="100%" style="border-radius: 10px; transform: scaleX(-1);"></video>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-5">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <center> Datos Acceso Vehicular </center>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo base_url ?>/QR/store" method="POST" class="form-horizontal 
                        form-label-left" novalidate>
                                        <form action="insertar.php" method="post" class="form-horizontal">

                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align"><i class="fa fa-qrcode fa-2x"></i><span class="required"> :</span></label>
                                                <div class="col-md-8 col-sm-4">
                                                    <input type="text" class="form-control" id="clave_vehiculo" name="clave_vehiculo" required="required" readonly>
                                                </div>
                                            </div>

                                            <div class="field item form-group">
                                                <label class=" col-form-label col-md-3 col-sm-3 label-align"><i class="fa fa-clock-o fa-2x"></i><span class="required"> :</span></label>
                                                <div class="col-md-8 col-sm-4 ">
                                                    <input type="text" class="form-control" id="horatxt" name="horatxt" readonly>
                                                </div>
                                            </div>


                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align"><i class="fa fa-calendar-o fa-2x"></i><span class="required"> :</span></label>
                                                <?php
                                                date_default_timezone_set("America/Mexico_City");
                                                $fcha = date("Y-m-d"); ?>
                                                <div class="col-md-8 col-sm-4">
                                                    <input type="date" class="form-control" id="fechatxt" name="fechatxt" required="required" value="<?php echo $fcha ?? '' ?>" readonly>
                                                    <span aria-hidden="true"></span>
                                                </div>
                                            </div>


                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align"><i class="fa fa-user fa-2x"></i><span class="required">:</span></label>
                                                <div class="col-md-8 col-sm-4">
                                                    <input type="text" class="form-control" id="resTurno" name="resTurno" required="required" value="<?php echo $_SESSION['nombre']; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align"><i class="fa fa-map-marker fa-2x"></i><span class="required">:</span></label>
                                                </label>
                                                <div class="col-md-8 col-sm-4">
                                                    <select class="form-control" name="selDestino">

                                                        <option selected value="">Sucursal Destino </option>
                                                        <?php foreach ($sucursales as $s) : ?>
                                                            <option value="<?php echo $s->nombre ?>"> <?php echo $s->nombre ?> </option>
                                                        <?php endforeach ?>


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align"><i class="fa fa-group fa-2x"></i><span class="required"> :</span></label>
                                                </label>
                                                <div class="col-md-8 col-sm-4">
                                                    <select class="form-control" name="selOper">

                                                        <option selected value="">Operador Encargado</option>
                                                        <?php foreach ($operadores as $op) : ?>
                                                            <option value="<?php echo $op->nombre ?>"> <?php echo $op->nombre ?> </option>
                                                        <?php endforeach ?>


                                                    </select>
                                                </div>
                                            </div>






                                        </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    Accesos Vehiculares Registrados
                                </div>
                                <div class="table-responsive">

                                    <div class="card-body">
                                        <table id="table" class="display nowrap table-hover table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Clave Vehiculo</th>
                                                    <th>Operador</th>
                                                    <th>Fecha</th>
                                                    <th>Destino</th>
                                                    <th>Hora de Entrada</th>
                                                    <th>Hora de Salida</th>
                                                    <th>Status</th>
                                                    <th>Salida / Eliminar</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <th>ID</th>
                                                <th>Clave Vehiculo</th>
                                                <th>Operador</th>
                                                <th>Fecha</th>
                                                <th>Destino</th>
                                                <th>Hora de Entrada</th>
                                                <th>Hora de Salida</th>
                                                <th>Status</th>
                                                <th>Salida / Eliminar</th>
                                            </tfoot>
                                            <tbody>
                                                <!--  $visitas viene de QRModel del metodo allvisitas() -->



                                                <?php if (empty($visitas)) : ?>
                                                    <p class="py-3 text-center">¡Aún no se registra ningun acceso vehicular ! </p>
                                                <?php else : ?>
                                                    <?php foreach ($visitas as $v) : ?>
                                                        <tr>
                                                            <td><?php echo $v->id; ?></td>
                                                            <td><?php echo $v->clave_vehiculo; ?></td>
                                                            <td><?php echo $v->operador_encargado; ?></td>
                                                            <td><?php echo $v->fecha; ?></td>
                                                            <td><?php echo $v->destino; ?></td>
                                                            <td><?php echo $v->hora_entrada; ?></td>
                                                            <td><?php echo $v->hora_salida; ?></td>
                                                            <?php if ($v->status) : ?>
                                                                <td><span class="badge badge-info">EN PROCESO</span></td>
                                                            <?php else : ?>
                                                                <td><span class="badge badge-danger">FINALIZADO</span></td>
                                                            <?php endif; ?>
                                                            <!--BOTONES DE ACCIONES  -->
                                                            <td>
                                                                <?php if (!empty($v->hora_salida)) { ?>
                                                                    <button id="vehiculoData" data-id="<?php echo $v->id ?>" data-clave="<?php echo $v->clave_vehiculo ?>" type="button" class="btn btn-success btn-sm" onclick="registrarSalidaVehiculos(this)" disabled style="background-color: gray;">
                                                                        <i class="fa fa-send text-white"></i>
                                                                    </button>
                                                                <?php } else { ?>
                                                                    <button id="vehiculoData" data-id="<?php echo $v->id ?>" data-clave="<?php echo $v->clave_vehiculo ?>" type="button" class="btn btn-success btn-sm" onclick="registrarSalidaVehiculos(this)">
                                                                        <i class="fa fa-send text-white"></i>
                                                                    </button>
                                                                <?php } ?>
                                                                <button id="accesoData" data-id="<?php echo $v->id ?>" data-clave="<?php echo $v->clave_vehiculo ?>" type="button" class="btn btn-danger btn-sm" onclick="eliminar(this)">
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
</div>
<!-- /page content -->



<script>
    var scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        scanPeriod: 5,
    });

    var cameras = [];

    Instascan.Camera.getCameras().then(function(camerasArray) {
        cameras = camerasArray;

        // Detectar si el usuario está accediendo desde un dispositivo móvil
        let cameraIndex = 0;
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            if (cameras.length > 1) {
                cameraIndex = 1; // Usar cámara trasera por defecto si hay disponible
            }
        }

        // Iniciar el escaneo
        if (cameras.length > 0) {
            scanner.start(cameras[cameraIndex]);
        } else {
            alert('No se encontró ninguna cámara en el dispositivo');
        }
    }).catch(function(e) {
        console.error(e);
    });
    scanner.addListener('scan', function(c) {
        document.getElementById('clave_vehiculo').value = c;
        document.forms[0].submit();
        var audio = new Audio('Imagenes/sonido.mp3');
        audio.play();
        scanner.stop();
    })
    document.getElementById("frontal").addEventListener("click", function() {
        if (cameras.length > 0 && cameras[0] != null) {
            scanner.stop();
            scanner.start(cameras[0]);
        } else {
            alert('No se encontró cámara frontal en el dispositivo');
        }
    });

    document.getElementById("trasera").addEventListener("click", function() {
        if (cameras.length > 1 && cameras[1] != null) {
            scanner.stop();
            scanner.start(cameras[1]);
        } else {
            alert('No se encontró cámara trasera en el dispositivo');
        }
    });

    document.getElementById("stop").addEventListener("click", function() {
        scanner.stop();
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