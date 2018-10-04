<?php echo form_open('Usuario/create_User');?>
<br><br>
<!-- Material form login -->
<div class="container card offset-3 col col-lg-6">
    <div class="card-block">
        <div class"form-header">
            <h5 class="card-header info-color white-text text-center py-4 lg-5">
            <strong>Crear Usuario</strong>
            </h5>
        </div>
        <div class="form-body mx-3">
            <div class="md-form mb-4">
                <i class="fa fa-vcard prefix grey-text"></i>
                <input type="text" name="txtNombre" id="defaultForm-user" class="form-control validate">
                <label>Ingrese su Nombre</label>
            </div>
            <div class="md-form mb-4">
                <i class="fa fa-vcard prefix grey-text"></i>
                <input type="text" name="txtApellido" id="defaultForm-apellido" class="form-control validate">
                <label>Ingrese Su Apellido</label>
            </div>
            <div class="md-form mb-4">
                <i class="fa fa-vcard prefix grey-text"></i>
                <input type="text" name="txtTelefono" id="defaultForm-telefono" class="form-control validate">
                <label >Telefono</label>
            </div>
            <div class="md-form mb-4">
                <!--Disabled option-->                
                <select name="txtCorreo" class="mdb-select colorful-select dropdown-primary">
                    <option value="0" selected>Seleccione un correo</option>
                    <?php foreach ($correos as $correo){?>
                    <option value="<?php echo $correo->idEmail; ?>"><?php echo $correo->email;}?></option>
                </select>                
            </div>
            <div class="md-form mb-4">
                <!--Disabled option-->                
                <select name="txtRol" class="mdb-select colorful-select dropdown-primary">
                    <option value="0" selected>Seleccione un Rol</option>
                    <?php foreach ($roles as $rol){?>
                    <option value="<?php echo $rol->idRol; ?>"><?php echo $rol->nombreRol;}?></option>
                </select>
            </div>
            <div class="md-form mb-4">
                <!--Disabled option-->                
                <select name="txtDepto" class="mdb-select colorful-select dropdown-primary">
                    <option value="0" selected>Seleccione un Rol</option>
                    <?php foreach ($deptos as $depto){?>
                    <option value="<?php echo $depto->idDepartamento; ?>"><?php echo $depto->nombreDepto;}?></option>
                </select>
            </div>
            <div class="text-center">
                <button class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div> 
</div>
<?php echo form_close(); ?>

