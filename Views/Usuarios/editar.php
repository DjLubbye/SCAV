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

              <li><a href="<?= base_url ?>/usuarios/nuevo" class=""><button class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Nuevo Usuario</button></a>
              </li>
              <li><a href="<?= base_url ?>/usuarios" class=""><button class="btn btn-info btn-sm"><i class="fa fa-list"></i> Lista de Usuarios</button></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <?php echo Alertas::mostraAlerta(); ?>

            <form action="<?php echo base_url ?>/usuarios/store" method="POST" class="form-horizontal form-label-left" novalidate>

              <?php include_once __DIR__ . '/form.php'; ?>

              <div class="col-md-6 col-sm-6 offset-md-3">
              <input type="submit" class="btn btn-warning" value="Actualizar" />
              </div>
              <?php debug($data['usuario']) ;?>




            </form>


          </div>
        </div>


      </div>
    </div>
  </div>
</div>

<!-- /page content -->

<script src="<?= JS ?>/bootstrap.bundle.min.js"></script>


<?php footerAdmin($data); ?>