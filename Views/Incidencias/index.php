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
              <li><a href="<?= base_url ?>/incidencias/nuevo" class=""><button class="btn btn-info btn-sm"><i class="fa fa-ban"></i> Nuevo Siniestro</button></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php echo Alertas::mostraAlerta(); ?>

            <table id="table" class="display nowrap table-hover table-bordered" style="width:100%">
              <thead>
                <tr>
                <th>ID</th>
                  <th>Folio</th>
                  <th>CEDIS</th>
                  <th>Razon Social</th>
                  <th>Siniestro</th>
                  <th>Destino</th>
                  <th>Operador</th>
                  <th>Placas</th>
                  <th>Estado</th>
                  <th>Municipio</th>
                  <th>Folio Aseguradora</th>
                  <th>Status SYF</th>
                  <th>Monto de Perdida</th>
                  <th>Status</th>
                  <th>Operaciones</th>
                </tr>
              </thead>

              <tfoot>
              <th>ID</th>
                  <th>Folio</th>
                  <th>CEDIS</th>
                  <th>Razon Social</th>
                  <th>Siniestro</th>
                  <th>Destino</th>
                  <th>Operador</th>
                  <th>Placas</th>
                  <th>Estado</th>
                  <th>Municipio</th>
                  <th>Folio Aseguradora</th>
                  <th>Status SYF</th>
                  <th>Monto de Perdida</th>
                  <th>Status</th>
                  <th>Operaciones</th>
              </tfoot>
              <tbody>
              <?php if(empty($siniestros)) : ?>
              <p class="py-3 text-center">¡Aún no registras ningun siniestro hasta ahora! </p>
                        <?php else : ?>
                <?php foreach ($siniestros as $i) : ?>
                  <tr>
                    <td><?php echo $i->id; ?></td>
                    <td><?php echo $i->folio; ?></td>
                    <td><?php echo $i->cedis; ?></td>
                    <td><?php echo $i->razon_social; ?></td>
                    <td><?php echo $i->tipo_siniestro; ?></td>

                    <td><?php echo $i->destino; ?></td>
                    <td><?php echo $i->conductor; ?></td>
                    <td><?php echo $i->placas_vehiculo; ?></td>
                    <td><?php echo $i->estado_ocurrecia; ?></td>
                    <td><?php echo $i->municipio_ocurrencia; ?></td>
                    <td><?php echo $i->folio_aseguradora; ?></td>
                    <td><?php echo $i->status_syf; ?></td>
                    <td><?php echo $i->monto_p_neta; ?></td>
                    <?php if ($i->estado_siniestro) : ?>
                      <td><span class="badge badge-success">Completado</span></td>
                    <?php else : ?>
                      <td><span class="badge badge-danger">Inconcluso</span></td>
                    <?php endif; ?>
                    <!--BOTONES DE ACCIONES  -->
                    <td>
                      <a type="button" class="btn btn-warning btn-sm" href="<?php echo base_url ?>/incidencias/edit/<?php echo $i->id ?>"><i class="fa fa-edit text-white"></i></a>
                      <button id="vehiculoData" data-id="<?php echo $i->id ?>" data-ecodl="<?php echo $i->folio ?>" type="button" class="btn btn-danger btn-sm" onclick="eliminarSiniestro(this)"><i class="fa fa-remove text-white"></i></button>
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
<!-- /page content -->



<?php footerAdmin($data); ?>