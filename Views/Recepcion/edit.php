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
                            
                            <li><a href="<?= base_url ?>/recepcion" class=""><button class="btn btn-info btn-sm"><i class="fa fa-list-ol"></i> Lista de Visitas</button></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php echo Alertas::mostraAlerta(); ?>
                        <!--FORMULARIO -->
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

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- /page content -->



    <?php footerAdmin($data); ?>