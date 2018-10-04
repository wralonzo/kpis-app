<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Paginación Codeigniter 3</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <table class="table table-striped">
    <?php
    if($usu)
    {
    ?>
        <tr>
            <th>
                Provincia
            </th>
        </tr>
        <?php
        foreach ($usu as $user)
        {
        ?>
            <tr>
                <td>
                    <?php echo $user->nombreUsuario ?>
                </td>
            </tr>
        <?php
        }
        ?>
    <?php
    }
    ?>
    </table>
    <nav class="my-4">
        <ul class="pagination pagination-circle pg-blue mb-0">  
            <li class="page-item enabled"><strong></strong>
                <a class="page-link" mdbWavesEffect aria-label="Previous"> <?php echo $this->pagination->create_links() ?>
                </a>
            </li>        
        </ul>
    </nav>
 
</body>
</html>