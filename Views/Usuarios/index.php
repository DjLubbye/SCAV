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


              <li><a href="<?= base_url ?>/usuarios/nuevo" class=""><button class="btn btn-info btn-sm"><i class="fa fa-plus-circle"></i> Nuevo Usuario</button></a>
              </li>

            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php echo Alertas::mostraAlerta(); ?>
            <table id="tblUsuarios" class="display nowrap table-hover table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Sucursal</th>
                  <th>Correo</th>
                  <th>Rol</th>
                  <th>Status</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tfoot>
              <th>ID</th>
                  <th>Nombre</th>
                  <th>Sucursal</th>
                  <th>Correo</th>
                  <th>Rol</th>
                  <th>Status</th>
                  <th>Acciones</th>
              </tfoot>
              <tbody>

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