<input type="hidden" name="id" value="<?php echo $recep->id ?? '' ?>">
<fieldset>

<div class="field item form-group"> 
<label class="col-form-label col-md-3 col-sm-3  label-align">Fecha Actual<span class="required">:</span></label>
    <?php 
        date_default_timezone_set("America/Mexico_City");
    $fcha = date("Y-m-d"); ?>
    <div class="col-md-8 col-sm-4">
    <input type="date" class="form-control" id="fechatxt" name="fechatxt" required="required" value="<?php echo $fcha ?? '' ?>" readonly>
    <span aria-hidden="true"></span>
  </div>
  </div>  

<div class="field item form-group"> 
<label class="col-form-label col-md-3 col-sm-3  label-align">Hora<span class="required">:</span></label>
    <?php 
date_default_timezone_set("America/Mexico_City");

$datetime = new DateTime();
$hora = $datetime->format("h:i A");

     ?>
    <div class="col-md-8 col-sm-4">
    <input type="text" class="form-control" id="horatxt" name="horatxt" required="required"  value="<?php echo $hora ?? '' ?>" readonly>
    <span aria-hidden="true"></span>
  </div>
  </div>

<div class="field item form-group">
    <label class="col-form-label col-md-3 col-sm-3  label-align">Responsable en Turno<span class="required">:</span></label>
    <div class="col-md-8 col-sm-4">
    <input type="text" class="form-control" id="resTurno" name="resTurno" required="required" value="<?php echo $_SESSION['nombre']; ?>" readonly>
    </div>
  </div>


  <div class="field item form-group">
  <label class="col-form-label col-md-3 col-sm-3  label-align">Gafete<span class="required">:</span></label>

  <div class="col-md-8 col-sm-4">
      <select class="form-control" name="gafete">
        <option select value="0">Seleccion el Gafete Correspondiente</option>
        <option value="P-1">P-1</option>
        <option value="P-2">P-2</option>
        <option value="P-3">P-3</option>
        <option value="P-4">P-4</option>
        <option value="P-5">P-5</option>
        <option value="P-6">P-6</option>
        <option value="P-7">P-7</option>
        <option value="P-8">P-8</option>
        <option value="P-9">P-9</option>
        <option value="P-10">P-10</option>
        <option value="P-11">P-11</option>
        
      </select>
    </div>
  </div>



  <div class="field item form-group">
    <label class="col-form-label col-md-3 col-sm-3  label-align">Nombre Completo del Visitante<span class="required">:</span></label>
    <div class="col-md-8 col-sm-4">
      <input class="form-control" id="nombreVisitante" name="nombreVisitante" type="text">
    </div>
  </div>


  <div class="field item form-group">
    <label class="col-form-label col-md-3 col-sm-3  label-align">Compañia<span class="required">:</span></label>
    <div class="col-md-8 col-sm-4">
      <input class="form-control" id="compania" name="compania" type="text">
    </div>
  </div>

  <div class="field item form-group">
    <label class="col-form-label col-md-3 col-sm-3  label-align">A quien Visita<span class="required">:</span></label>
    <div class="col-md-8 col-sm-4">
      <input class="form-control" name="aVisita" type="aVisita">
    </div>
  </div>

  <div class="field item form-group">
  <label class="col-form-label col-md-3 col-sm-3  label-align">Asunto<span class="required">:</span></label>

  <div class="col-md-8 col-sm-4">
      <select class="form-control" name="selAsunto">
       <option select value="S/A">Asunto de la Visita</option>
        <option value="Entrega">Entrega</option>
        <option value="Recoleccion/Carga">Recoleccion/Carga</option>
        <option value="Empleado sin Gafete">Empleado sin Gafete</option>
        <option value="Nuevo Ingreso">Nuevo Ingreso</option>
        <option value="Herramientas">Herramientas</option>
        <option value="Trabajos">Trabajos Internos</option>
        <option value="Junta">Junta</option>
        <option value="Finiquito">Finiquito</option>
        <option value="Citatorio/Diligencias">Citatorio/Diligencias</option>
        <option value="Servicios">Servicios(Basura,Gas,Agua)</option>
        <option value="Alimentos">Alimentos</option>
        <option value="Cursos">Cursos</option>
        </select>
    </div>
  </div>


  
 
</fieldset>