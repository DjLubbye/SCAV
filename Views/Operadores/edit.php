<?php
headerAdmin($data);
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php echo $data['page_name']; ?></h3>
      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav navbar-right panel_toolbox">
              <li><a href="<?= base_url ?>/operadores" class=""><button class="btn btn-info btn-sm"><i class="fa fa-users"></i> Lista de Operadores</button></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php echo Alertas::mostraAlerta(); ?>

            <form action="<?php echo base_url ?>/operadores/store" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>

              <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                  <?php include_once __DIR__ . '/form.php'; ?>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 offset-md-3">
                <input type="submit" class="btn btn-warning" value="Actualizar" />
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->



<?php footerAdmin($data); ?>