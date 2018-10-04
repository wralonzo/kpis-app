<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container table-responsive">
    <table class="animated bounce container table-responsive-md table table-hover" id='tblUsuario'>
        <thead>
            <tr>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Telefono</td>
            </tr>
        </thead>
        
        <tbody>  <?php foreach ($user as $usuario){?>          
                <tr>
                    <td><?php echo $usuario->nombreUsuario;?></td>
                    <td><?php echo $usuario->apellidoUsuario;?></td>
                    <td><?php echo $usuario->telefono;?></td>
                    <td><?php echo $usuario->email;?></td>
                    <td><?php echo $usuario->nombreDepto;?></td>
                    <td><?php echo $usuario->nombreRol;}?></td>
                   
                </tr>
                <?php}?>
        </tbody>
        
    </table>
   
</div>
</body>
</html>