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
              <li><a href="<?= base_url ?>/sucursal/nuevo" class=""><button class="btn btn-info btn-sm"><i class="fa fa-building"></i> Nueva Sucursal</button></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="table-responsive">
            <?php echo Alertas::mostraAlerta(); ?>
            <table id="table" class="display nowrap table-hover table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Sucursal</th>
                  <th>Direccion</th>
                  <th>Tipo</th>
                  <th>Status</th>
                  <th>Operaciones</th>
                </tr>
              </thead>

              <tfoot>
                <th>ID</th>
                <th>Sucursal</th>
                <th>Direccion</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Operaciones</th>
              </tfoot>
              <tbody>

                <?php if (empty($sucursal)) : ?>
                  <p class="py-3 text-center">¡Aún no existen registros! </p>
                <?php else : ?>

                  <?php foreach ($sucursal as $s) : ?>

                    <td><?php echo $s->id; ?></td>
                    <td><?php echo $s->nombre; ?></td>
                    <td><?php echo $s->direccion; ?></td>
                    <td><?php echo $s->tipo; ?></td>
                    <?php if ($s->status) : ?>
                      <td><span class="badge badge-success">Activo</span></td>
                    <?php else : ?>
                      <td><span class="badge badge-danger">Inactivo</span></td>
                    <?php endif; ?>
                    <!--BOTONES DE ACCIONES  -->
                    <td>
                      <a type="button" class="btn btn-warning btn-sm" href="<?php echo
                                                                            base_url ?>/sucursal/edit/<?php echo $s->id ?>"><i class="fa fa-edit 
                      text-white"></i></a>

                      <button id="sucursalData" data-id="<?php echo $s->id ?>" data-nombre="<?php echo $s->nombre ?>" type="button" class="btn btn-danger btn-sm" onclick="eliminarSucursal(this)"><i class="fa fa-remove text-white"></i></button>
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