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
              <li><a href="<?= base_url ?>/operadores/nuevo" class=""><button class="btn btn-info btn-sm"><i class="fa fa-users"></i> Nuevo Operador </button></a>
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
                  <th>Fotografia</th>
                  <th>Nombre Completo</th>
                  <th>Correo Electronico</th>
                  <th>Telefono de Contacto</th>
                  <th>Status</th>
                  <th>Operaciones</th>
                </tr>
              </thead>
              <tfoot>
                <th>ID</th>
                <th>Fotografia</th>
                <th>Nombre Completo</th>
                <th>Correo Electronico</th>
                <th>Telefono de Contacto</th>
                <th>Status</th>
                <th>Operaciones</th>
              </tfoot>
              <tbody>
                <!--  $operadores viene de operadoresModel del metodo allOperadores -->
                <?php if(empty($operadores)) : ?>
              <p class="py-3 text-center">¡Aún no registras ningun operador vehicular! </p>
                        <?php else : ?>
                <?php foreach ($operadores as $o) : ?>
                  <tr>
                    <td><?php echo $o->id; ?></td>
                    <td><img class="img-thumbnail" width="100px" src="<?php echo base_url ?>/Imagenes/.<?php echo $o->foto; ?>" /</td>
                    <td><?php echo $o->nombre; ?></td>
                    <td><?php echo $o->correo; ?></td>
                    <td><?php echo $o->celular; ?></td>
                    <?php if ($o->status) : ?>
                      <td><span class="badge badge-success">Activo</span></td>
                    <?php else : ?>
                      <td><span class="badge badge-danger">Inactivo</span></td>
                    <?php endif; ?>
                    <!--BOTONES DE ACCIONES  -->
                    <td>
                      <a type="button" class="btn btn-warning btn-sm" href="<?php echo
                                                                            base_url ?>/operadores/edit/<?php echo $o->id ?>"><i class="fa fa-edit 
                      text-white"></i></a>



                      <button id="vehiculoData" data-id="<?php echo $o->id ?>" data-nombre="<?php echo $o->nombre ?>" type="button" class="btn btn-danger btn-sm" onclick="eliminarOperador(this)"><i class="fa fa-remove text-white"></i></button>
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