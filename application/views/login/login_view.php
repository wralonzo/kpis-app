<br>
<?php if($this->session->flashdata('errors')): ?>

    <?php echo $this->session->flashdata('errors'); ?>

<?php endif; ?>
<?php echo form_open('Login/start_Login');?>
<!-- Material form login -->
<div class="container card col-lg-5">
    <div class="card-block">
        <div class"form-header">
            <h5 class="card-header info-color white-text text-center py-4">
            <strong>Autenticacion</strong>
            </h5>
        </div>
        <div class="form-body mx-3">
            <div class="md-form mb-5">
                <i class="fa fa-vcard prefix grey-text"></i>
                <input type="text" name="txtUser" id="defaultForm-user" class="form-control validate" required="">
                <label data-error="wrong" data-success="good" for="defaultForm-email">Ingrese Usuario</label>
            </div>
            <div class="md-form mb-5">
                <i class="fa fa-vcard prefix grey-text"></i>
                <input type="password" name="txtPassword" id="defaultForm-apellido" class="form-control validate"  required="">
                <label data-error="wrong" data-success="good" for="defaultForm-email">Ingrese su password</label>
            </div>
            <table>
            <tr>
                <th>
                    <button class="btn btn-primary">Entrar</button>
                </th>
                <th>
                    Google
                </th>
                <th>
                <div class="g-signin2" data-onsuccess="onSignIn" value='value' data-theme="dark">Iniciar con google</div>
                </th>    
            </tr>
            </table>
            <div class="text-center">
                
                
            </div>
        </div>
    </div> 
</div>
<?php echo form_close(); ?>

  

