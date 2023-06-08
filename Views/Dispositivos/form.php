
<!--
 $vehi viene de a funcion edit del controlador que 
instancia al modelo el metodo editVeh
 -->
<input type="hidden" name="id" value="<?php echo $vehi->id ?? '' ?>">

<fieldset>

<div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="tipo" name="tipo" required="required" placeholder="Tipo de Vehiculo" value="<?php echo $vehi->tipo ?? '' ?>">
<span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
</div>



<div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="marca" name="marca" required="required" placeholder="Marca" value="<?php echo $vehi->marca ?? '' ?>">
<span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
</div>

<div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="serie" name="serie" required="required" placeholder="Numero de Serie" value="<?php echo $vehi->serie ?? '' ?>">
<span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
</div>

<div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="placas" name="placas" required="required" placeholder="Placas" value="<?php echo $vehi->placas ?? '' ?>">
<span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
</div>

<div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="m3" name="m3" required="required" placeholder="M3" value="<?php echo $vehi->m3 ?? '' ?>">
<span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
</div>

<div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="eco_dl" name="eco_dl" required="required" placeholder="ECO.DL" value="<?php echo $vehi->eco_dl ?? '' ?>">
<span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
</div>

<div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="u_n" name="u_n" required="required" placeholder="U.N" value="<?php echo $vehi->u_n ?? '' ?>">
<span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
</div>

<div class="col-md-10 col-sm-2  form-group has-feedback">
    <div class="col-md-12 col-sm-2 ">
      <select class="form-control" name="selStatus">
        <?php
        if (isset($vehi)) {
          if ($vehi->activo == 1)
            echo ' <option select value="1">Activo</option>
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>';
          elseif ($vehi->activo == 0) {
            echo ' <option select value="0">Inactivo</option>
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>';
          }
        } else {
          echo ' <option select value="0">Status del Vehiculo</option>
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>';
        }
        ?>
      </select>
    </div>
  </div>

  


  <div class="col-md-10 col-sm-2  form-group has-feedback">
<input type="text" class="form-control" id="id_operador" name="id_operador" required="required" placeholder="Operador Responsable" value="<?php echo $vehi->id_operador ?? '' ?>">
<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
</div>

<div class="col-md-10 col-sm-2  form-group has-feedback">
<?php $fcha = date("Y-m-d");?>
<input type="hidden" class="form-control" id="fechar" name="fecha" required="required" value="<?php echo $fcha ?? '' ?>" readonly>
<span aria-hidden="true"></span>
</div>


</fieldset>