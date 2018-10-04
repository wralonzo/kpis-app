<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Principal</title>
    <!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>-->

    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>

    <!-- datepicker -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>

    <!-- pace -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/pace.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>


    <!-- libreria moment -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.js"></script> 
    <meta name="google-signin-scope" content="profile email">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="631861547541-pqptvsib29q5mbq51pgl2v5tqm6rafbl.apps.googleusercontent.com">
  

    <script type="text/javascript" src="<?php echo base_url();?>js/login_google/login_google.js"></script>

    <!-- Font Awesome -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">

    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sweetalert.css">-->

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url();?>assets/css/mdb.min.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

    <!-- datepicker -->
    <!--<link href="<?php echo base_url();?>assets/css/bootstrap-datepicker.css" rel="stylesheet">-->

    <!-- estilo pace -->
    <link href="<?php echo base_url();?>assets/css/pace-theme-center-circle.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script> 


</body>
</html>
</head>
<body style="background-color:#bbdefb;">

<script type="text/javascript" src="<?php echo base_url();?>assets/js/mdb.min.js"></script><nav class="nav grey lighten-4 py-4">
<div class="container col-md-12">

        <nav class="navbar navbar-toggleable-md navbar-dark bg-primary">
            <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapseEx12" aria-controls="collapseEx2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">System KPI</a>
                <div class="collapse navbar-collapse" id="collapseEx12">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <?php if ($this->session->userdata("logueado")):?>
                        <li class="nav-item btn-group">
-                            <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item" href="<?php echo base_url(); ?>kpi">kpis</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>kpi/create_Kpi">Nuevo</a>
                        </li>


                        <li class="nav-item btn-group">
                            <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USERS</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item" href="<?php echo base_url(); ?>Usuario/create_User">New</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>Usuario">Show</a>
                            </div>
                        </li>


                        <li class="nav-item btn-group">
                            <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Graficas</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item" href="<?php echo base_url();?>kpi/">grafica1</a>                             
                            </div>
                        </li>

                        <li class="nav-item btn-group">
                            <a class="nav-link" href="<?php echo base_url();?>users/display">Usuarios</a>
                        </li>
                        <li class="nav-item btn-group">
                            <a class="nav-link" href="<?php echo base_url();?>pago/do_upload">Importar Excel</a>
                        </li>
                    </ul>
                    <ul class="navbar-toggler-right">
                        <li class="nav-item btn-group">
                            <a class="nav-link" href="<?php echo base_url();?>users/update_pass">Cambiar Contraseña</a>
                            <a class="nav-link" href="<?php echo base_url(); ?>Login/logout">Salir</a>
                            <a href="#" onclick="signOut();">Sign out</a>
                            <script>
                            function signOut() {
                                var auth2 = gapi.auth2.getAuthInstance();
                                auth2.signOut().then(function () {
                                console.log('User signed out.');
                                });
                            }
                            </script>

                        </li>

                    </ul>
                    <?php  endif;?>
                </div>
            </div>
        </nav>
    </div>
</nav>
