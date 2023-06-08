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
              <li><a href="<?= base_url ?>/roles/nuevo" class=""><button class="btn btn-info btn-sm"><i class="fa fa-plus-circle"></i> Nuevo Rol</button></a>
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
                  <th>Rol</th>
                  <th>Status</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <!--  -->
                <?php foreach ($roles as $r) : ?>
                  <tr>
                    <td></td>
                    <td><?php echo $r->nombre; ?></td>
                    <?php if ($r->activo) : ?>
                      <td><span class="badge badge-info">Activado</span></td>
                    <?php else : ?>
                      <td><span class="badge badge-danger">Desactivado</span></td>
                    <?php endif; ?>
                    <!--BOTONES DE ACCIONES  -->
                    <td>
                    <a type="button" class="btn btn-info btn-sm" href="<?php echo 
                      base_url ?>/permiso/index/<?php echo $r->id ?>"><i class="fa fa-key 
                      text-white"></i></a>

                      <a type="button" class="btn btn-warning btn-sm" href="<?php echo 
                      base_url ?>/roles/edit/<?php echo $r->id ?>"><i class="fa fa-edit 
                      text-white"></i></a>

                      <button id="rolData" data-idrol="<?php echo $r->id ?>" data-namerol="<?php echo $r->nombre ?>" type="button" class="btn btn-danger btn-sm" onclick="eliminarFnt(this)"><i class="fa fa-remove text-white"></i></button>
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