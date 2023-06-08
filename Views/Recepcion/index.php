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
              <li><a href="<?= base_url ?>/recepcion/nuevo" class=""><button class="btn btn-info btn-sm"><i class="fa fa-book"></i> Registrar Visita</button></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <?php echo Alertas::mostraAlerta(); ?>


            <div class="col-md-12">
              <br>
              <div class="card">
                <div class="card-header text-cente">
                  INGRESA LOS DATOS DEL VISITANTE

                </div>
                <div class="card-body">
                  <form action="<?php echo base_url ?>/recepcion/store" method="POST" class="form-horizontal 
                        form-label-left" novalidate>


                    <div class="row d-flex justify-content-center">
                      <div class="col-md-6">
                        <?php include_once __DIR__ . '/form.php'; ?>
                      </div>
                    </div>
                    <!-- BOTONES  -->
                    <div class="col-md-6 col-sm-6 offset-md-3">
                      <input type="submit" class="btn btn-success" value="Guardar" />
                    </div>


                </div>
              </div>
            </div>



            <div class="col-md-12">
              <br>
              <div class="card">
                <div class="card-header">
                  Visitas
                </div>
                <div class="card-body">

                  <table id="table" class="display nowrap table-hover table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre Visitante</th>
                        <th>Compañia</th>
                        <th>A quien Visita</th>
                        <th>Asunto</th>
                        <th>H.Entrada</th>
                        <th>Fecha</th>
                        <th>Status</th>
                        <th>H.Salida</th>
                        <th>Responsable</th>
                        <th>Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php if (empty($recepcion)) : ?>
                        <p class="py-3 text-center">¡ Aún no se registrs ningun acceso en el dia ! </p>
                      <?php else : ?>


                        <?php foreach ($recepcion as $r) : ?>
                          <tr>
                            <td><?php echo $r->id; ?></td>
                            <td><?php echo $r->nombre; ?></td>
                            <td><?php echo $r->compania; ?></td>
                            <td><?php echo $r->visita_a; ?></td>
                            <td><?php echo $r->asunto; ?></td>
                            <td><?php echo $r->h_entrada; ?></td>
                            <td><?php echo $r->fecha; ?></td>
                            <?php if ($r->status) : ?>
                              <td><span class="badge badge-success">Dentro de Instalacions</span></td>
                            <?php else : ?>
                              <td><span class="badge badge-danger">Registro Salida</span></td>
                            <?php endif; ?>
                            <td><?php echo $r->h_salida; ?></td>
                            <td><?php echo $r->responsable; ?></td>
                            <!--BOTONES DE ACCIONES  -->
                            <td>

                              <a type="button" class="btn btn-warning btn-sm" href="<?php echo
                                                                                    base_url ?>/recepcion/edit/<?php echo $r->id ?>"><i class="fa fa-edit 
                      text-white"></i></a>
                              <?php if (empty($r->h_salida)) { ?>
                                <button id="vehiculoData" data-id="<?php echo $r->id ?>" data-clave="<?php echo $r->nombre ?>" type="button" class="btn btn-success btn-sm" onclick="registrarSalida(this)"><i class="fa fa-send text-white"></i></button>
                              <?php } ?>
                              <button id="Data" data-id="<?php echo $r->id ?>" data-name="<?php echo $r->nombre ?>" type="button" class="btn btn-danger btn-sm" onclick="eliminarVisita(this)"><i class="fa fa-remove text-white"></i></button>

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
  <!-- /page content -->



  <?php footerAdmin($data); ?>