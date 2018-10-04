<?php echo form_open('Login/create');?>
<br><br>
<!-- Material form login -->
<div class="container card col-lg-5">
    <div class="card-block">
        <div class"form-header">
            <h5 class="card-header info-color white-text text-center py-4">
            <strong>Crear Cuenta de Usuario</strong>
            </h5>
        </div>
        <div class="form-body mx-3">
            <div class="md-form mb-5">
                <i class="fa fa-vcard prefix grey-text"></i>
                <input type="text" name="txtUser" id="defaultForm-user" class="form-control validate">
                <label data-error="wrong" data-success="right" for="defaultForm-email">Ingrese su Usuario</label>
            </div>
            <div class="md-form mb-5">
                <i class="fa fa-vcard prefix grey-text"></i>
                <input type="text" name="txtPassword" id="defaultForm-apellido" class="form-control validate">
                <label data-error="wrong" data-success="right" for="defaultForm-email">Ingrese Password</label>
            </div>
            <div class="md-form mb-5">
                <i class="fa fa-vcard prefix grey-text"></i>
                <input type="text" name="txt" id="defaultForm-telefono" class="form-control validate">
                <label data-error="wrong" data-success="right" for="defaultForm-telefono">Repita Password</label>
            </div>
            <div class="md-form mb-5">
                <!--Disabled option-->                
                <select name="txtUsuario" class="mdb-select colorful-select dropdown-primary">
                    <option value="0" selected>Seleccione Usuario</option>
                    <?php foreach ($user_data as $usuario){?>
                    <option value="<?php echo $usuario->idUsuario; ?>"><?php echo $usuario->nombreUsuario;}?></option>
                </select>                
            </div>
            
            <div class="text-center">
                <button class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div> 
</div>
<?php echo form_close(); ?>

