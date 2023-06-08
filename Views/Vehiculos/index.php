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
              <li><a href="<?= base_url ?>/vehiculos/nuevo" class=""><button class="btn btn-info btn-sm"><i class="fa fa-truck"></i> Nuevo Vehiculo</button></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="table-responsive">
            <?php echo Alertas::mostraAlerta(); ?>

            <table id="table" class="display nowrap table-hover table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Eco.Dl</th>
                  <th>Tipo</th>
                  <th>Marca</th>
                  <th>Serie</th>
                  <th>Placas</th>
                  <th>M3</th>
                  <th>U.N</th>
                  <th>Satatus</th>
                  <th>Codigo QR</th>
                  <th>Fecha de Alta</th>
                  <th>Operador</th>
                  <th>Operaciones</th>
                </tr>
              </thead>

              <tfoot>
                <th>Eco.Dl</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Serie</th>
                <th>Placas</th>
                <th>M3</th>
                <th>U.N</th>
                <th>Satatus</th>
                <th>Codigo QR</th>
                <th>Fecha de Alta</th>
                <th>Operador</th>
                <th>Operaciones</th>
              </tfoot>
              <tbody>


                <?php foreach ($vehiculos as $v) : ?>
                  <tr>
                    <td><?php echo $v->eco_dl; ?></td>
                    <td><?php echo $v->tipo; ?></td>
                    <td><?php echo $v->marca; ?></td>
                    <td><?php echo $v->serie; ?></td>
                    <td><?php echo $v->placas; ?></td>
                    <td><?php echo $v->m3; ?></td>
                    <td><?php echo $v->u_n; ?></td>

                    <?php if ($v->activo) : ?>
                      <td><span class="badge badge-success">Activo</span></td>
                    <?php else : ?>
                      <td><span class="badge badge-danger">Inactivo</span></td>
                    <?php endif; ?>
                    <td><img src="<?php echo base_url . "/Imagenes/" . $v->QR; ?>" width="70" height="70" /></td>
                    <td><?php echo $v->fecha_alta; ?></td>
                    <td><?php echo $v->id_operador; ?></td>
                    <!--BOTONES DE ACCIONES  -->
                    <td>
                      <a type="button" class="btn btn-warning btn-sm" href="<?php echo base_url ?>/vehiculos/edit/<?php echo $v->id ?>"><i class="fa fa-edit text-white"></i></a>

                      <button id="vehiculoData" data-id="<?php echo $v->id ?>" data-ecodl="<?php echo $v->eco_dl ?>" type="button" class="btn btn-danger btn-sm" onclick="eliminarVehiculo(this)"><i class="fa fa-remove text-white"></i></button>

                      <a type="button" class="btn btn-info btn-sm" href="<?php echo base_url ?>/vehiculos/edit/<?php echo $v->id ?>"><i class="fa fa-credit-card  text-white"></i></a>

                    </td>
                  </tr>
                <?php endforeach; ?>

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