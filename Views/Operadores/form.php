<input type="hidden" name="id" value="<?php echo $oper->id ?? '' ?>">

<fieldset>


    <div class="col-md-12 form-group has-feedback">
        <input type="text" class="modal-content form-control has-feedback-left" id="nombre" name="nombre" required="required" placeholder=" Nombre Completo" value="<?php echo $oper->nombre ?? '' ?>">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    </div>
    
    <div class="col-md-12 col-sm-2  form-group has-feedback">
        <input type="email" class="form-control has-feedback-left" id="correo" name="correo" required="required" placeholder="Correo" value="<?php echo $oper->correo ?? '' ?>">
        <span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
    </div>

    <div class="col-md-12  col-sm-2  form-group has-feedback">
        <input type="tel" class="form-control has-feedback-left" id="celular" name="celular" required="required" placeholder="Telefono" value="<?php echo $oper->celular ?? '' ?>">
        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
    </div>

    <div class="col-md-12 col-sm-2  form-group has-feedback">
        <div class="col-md-12 col-sm-2 ">
            <select class="form-control" name="selStatus" >
                <?php
                if (isset($oper)) {
                    if ($oper->status == 1)
                        echo ' <option select value="1">Activo</option>
        <option value="1">Activo</option>
        <option value="0">Baja</option>';
                    elseif ($oper->status == 0) {
                        echo ' <option select value="0">Baja</option>
        <option value="1">Activo</option>
        <option value="0">Baja</option>';
                    }
                } else {
                    echo ' <option select value="0">Status del Operador</option>
        <option value="1">Activo</option>
        <option value="0">Baja</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-12 col-sm-2  form-group has-feedback">
        <input type="file" class="form-control" id="txtimagen" name="txtimagen" >
    </div>



</fieldset>