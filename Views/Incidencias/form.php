<input type="hidden" name="id" value="<?php echo $siniestro->id ?? '' ?>">


<div class="field item form-group">
  <label class="col-form-label col-md-3 col-sm-3  label-align">Responsable <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="text" class="form-control" id="nombre" name="nombre" required="required" value="<?php echo $_SESSION['nombre']; ?>" readonly>
  </div>
</div>

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Fecha <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="date" id="fecha" name="fecha" required="required" class="form-control " value="<?php echo $siniestro->nombre_usuario ?? '' ?>">
  </div>
</div>

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hora <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="time" id="hora" name="hora" required="required" class="form-control " value="<?php echo $usuario->email ?? '' ?>">
  </div>
</div>



<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">CEDIS <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <select class="form-control" name="cedis">

      <?php if (empty($siniestro)) : ?>
        <option selected value="">Centro de Distribucion</option>
        <?php foreach ($sucursales as $s) : ?>
          <option value="<?php echo $s->nombre ?>"> <?php echo $s->nombre ?> </option>
        <?php endforeach ?>

      <?php else : ?>
        <option selected value="<?php echo $siniestro->id ?>"> <?php echo $siniestro->cedis ?> </option>

        <?php foreach ($sucursal as $s) : ?>
          <option value="<?php echo $s->nombre ?>"> <?php echo $s->nombre ?> </option>
        <?php endforeach ?>
      <?php endif; ?>

    </select>
  </div>
</div>


<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Razon Social <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <select class="form-control" name="razon_social">
      <option select value="">Seleccione una Razon Social</option>
      <option value="Banco Azteca">Banco Azteca</option>
      <option value="Elektra Del Milenio SA de CV 017">Elektra Del Milenio SA de CV 017</option>
      <option value="Comercializ Motocicletas (903)">Comercializ Motocicletas (903)</option>
      <option value="Otra">Otra</option>
    </select>
  </div>
</div>

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo de Siniestro <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <select class="form-control" name="tipo_siniestro">
      <option select value="">Selecciona el Siniestro</option>
      <option value="Colision">Colision</option>
      <option value="Daño a caja">Daño a caja</option>
      <option value="Daño a unidad por roca">Daño a unidad por roca</option>
      <option value="Incendio">Incendio</option>
      <option value="Parcial">Parcial</option>
      <option value="Robo E-Commerce">Robo E-Commerce</option>
      <option value="Robo Parcial">Robo Parcial</option>
      <option value="Robo Pequeños Y Valiosos">Robo Pequeños Y Valiosos</option>
      <option value="Robo Refacciones">Robo Refacciones</option>
      <option value="Robo Total">Robo Total</option>
      <option value="Volcadura">Volcadura</option>
      <option value="Otro">Otro</option>
    </select>
  </div>
</div>

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Operador <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <select class="form-control" name="conductor">

      <?php if (empty($siniestro)) : ?>
        <option selected value="">Selecciona un Operador</option>
        <?php foreach ($operadores as $o) : ?>
          <option value="<?php echo $o->nombre ?>"> <?php echo $o->nombre ?> </option>
        <?php endforeach ?>

      <?php else : ?>
        <option selected value="<?php echo $siniestro->id ?>"> <?php echo $siniestro->cedis ?> </option>

        <?php foreach ($operadores as $o) : ?>
          <option value="<?php echo $o->nombre ?>"> <?php echo $o->nombre ?> </option>
        <?php endforeach ?>
      <?php endif; ?>

    </select>
  </div>
</div>

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Placas <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <select class="form-control" name="placas">

      <?php if (empty($usuario)) : ?>
        <option selected value="">Placas de la Unidad Afectada</option>
        <?php foreach ($placas as $p) : ?>
          <option value="<?php echo $p->placas ?>"> <?php echo $p->placas ?> </option>
        <?php endforeach ?>

      <?php else : ?>
        <option selected value="<?php echo $usuario->id_sucursal ?>"> <?php echo $usuario->sucursal ?> </option>

        <?php foreach ($placas as $p) : ?>
          <option value="<?php echo $p->placas ?>"> <?php echo $p->placas ?> </option>
        <?php endforeach ?>
      <?php endif; ?>

    </select>
  </div>
</div>
<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Estado <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <select class="form-control" name="estado_ocurrecia">
      <option select value="">Estado Ocurrencia </option>
      <option value="Aguascalientes">Aguascalientes</option>
      <option value="Baja California">Baja California</option>
      <option value="Baja California Sur">Baja California Sur</option>
      <option value="Campeche">Campeche</option>
      <option value="Chiapas">Chiapas</option>
      <option value="Chihuahua">Chihuahua</option>
      <option value="Coahuila">Coahuila</option>
      <option value="Colima">Colima</option>
      <option value="Distrito Federal">Distrito Federal</option>
      <option value="Durango">Durango</option>
      <option value="Estado de México">Estado de México</option>
      <option value="Guanajuato">Guanajuato</option>
      <option value="Guerrero">Guerrero</option>
      <option value="Hidalgo">Hidalgo</option>
      <option value="Jalisco">Jalisco</option>
      <option value="Michoacán">Michoacán</option>
      <option value="Morelos">Morelos</option>
      <option value="Nayarit">Nayarit</option>
      <option value="Nuevo León">Nuevo León</option>
      <option value="Oaxaca">Oaxaca</option>
      <option value="Puebla">Puebla</option>
      <option value="Querétaro">Querétaro</option>
      <option value="Quintana Roo">Quintana Roo</option>
      <option value="San Luis Potosí">San Luis Potosí</option>
      <option value="Sinaloa">Sinaloa</option>
      <option value="Sonora">Sonora</option>
      <option value="Tabasco">Tabasco</option>
      <option value="Tamaulipas">Tamaulipas</option>
      <option value="Tlaxcala">Tlaxcala</option>
      <option value="Veracruz">Veracruz</option>
      <option value="Yucatán">Yucatán</option>
      <option value="Zacatecas">Zacatecas</option>
    </select>
  </div>
</div>

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Municipio Ocurrencia <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="text" id="municipio_ocurrencia" name="municipio_ocurrencia" required="required" class="form-control " value="<?php echo $usuario->nombre_usuario ?? '' ?>">
  </div>
</div>

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Folio Aseguradora<span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="text" id="folio_aseguradora" name="folio_aseguradora" required="required" class="form-control " value="<?php echo $usuario->nombre_usuario ?? '' ?>">
  </div>
</div>
<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Status SYF<span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="text" id="status_syf" name="status_syf" required="required" class="form-control " value="<?php echo $usuario->nombre_usuario ?? '' ?>">
  </div>
</div>



<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Centro de Costos <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="text" id="centro_costos" name="centro_costos" required="required" class="form-control " value="<?php echo $siniestro->nombre_usuario ?? '' ?>">
  </div>
</div>

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Destino <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="text" id="destino" name="destino" required="required" class="form-control " value="<?php echo $siniestro->destino ?? '' ?>">
  </div>
</div>


<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Averiguacion Previa <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="text" id="av_pre" name="av_pre" required="required" class="form-control " value="<?php echo $siniestro->averiguacion_p ?? '' ?>">
  </div>
</div>


<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Numero Economico <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="text" id="numero_economico" name="numero_economico" required="required" class="form-control " value="<?php echo $siniestro->numero_economico ?? '' ?>">
  </div>
</div>






<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Valor Total Embarque <span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="number" step="0.01" id="valor_t_embarque" name="valor_t_embarque" required="required" class="form-control " value="<?php echo $usuario->nombre_usuario ?? '' ?>"><br>

  </div>
</div>

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Monto Perdida Bruta<span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="number" step="0.01" id="perdida_bruta" name="perdida_bruta" required="required" class="form-control " value="<?php echo $usuario->nombre_usuario ?? '' ?>"><br>

  </div>
</div>
<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Deducible<span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="number" step="0.01" id="deducible" name="deducible" required="required" class="form-control " value="<?php echo $usuario->nombre_usuario ?? '' ?>"><br>

  </div>
</div>
<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Perdida Neta<span class="required">:</span>
  </label>
  <div class="col-md-8 col-sm-8 ">
    <input type="number" step="0.01" id="monto_p_netav" name="monto_p_neta" required="required" class="form-control " value="<?php echo $usuario->nombre_usuario ?? '' ?>"><br>

  </div>
</div>

<div class="field item form-group bad">
  <label class="col-form-label col-md-3 col-sm-3  label-align">Sucesos Ocurridos <span class="required">:</span></label>
  <div class="col-md-10 col-sm-10">
    <textarea required="required" name="resumen"></textarea>
  </div>