
<!--
 $vehi viene de a funcion edit del controlador que 
instancia al modelo el metodo editVeh
 -->
<input type="hidden" name="id" value="<?php echo $sucursal->id ?? '' ?>">

<fieldset>

<div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="nombre" name="nombre" required="required" placeholder="Nombre de la Sucursal" value="<?php echo $sucursal->nombre ?? '' ?>">
<span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
</div>



<div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="direccion" name="direccion" required="required" placeholder="Direccion de la Sucursal" value="<?php echo $sucursal->direccion ?? '' ?>">
<span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
</div>

<div class="col-md-10 col-sm-2  form-group has-feedback">
      <select class="form-control" name="tipo">
        <?php
        if (isset($sucursal)) {
          if ($sucursal->tipo == "Centro de Distribucion")
            echo ' <option select value="Centro de Distribucion">Centro de Distribucion</option>
        <option value="Centro de Distribucion">Centro de Distribucion</option>
        <option value="Hub">Hub</option>';
          elseif ($sucursal->tipo == "Hub") {
            echo ' <option select value="Hub">Hub</option>
        <option value="Centro de Distribucion">Centro de Distribucion</option>
        <option value="Hub">Hub</option>';
          }
        } else {
          echo ' <option select value="">Tipo Sucursal</option>
        <option value="Centro de Distribucion">Centro de Distribucion</option>
        <option value="Hub">Hub</option>';
        }
        ?>
      </select>
  </div>


<div class="col-md-10 col-sm-2  form-group has-feedback">
      <select class="form-control" name="selStatus">
        <?php
        if (isset($sucursal)) {
          if ($sucursal->status == 1)
            echo ' <option select value="1">Activo</option>
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>';
          elseif ($sucursal->status == 0) {
            echo ' <option select value="0">Inactivo</option>
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>';
          }
        } else {
          echo ' <option select value="0">Status de la Sucursal</option>
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>';
        }
        ?>
      </select>
  </div>




</fieldset>