
<?php 
    session_start();

    require 'database.php';
    
    if(isset($_SESSION['iduser'])) {
        $records = $conn->prepare ('SELECT iduser, email, clave from user where iduser = :iduser');
        $records->bindParam(':iduser', $_SESSION['iduser']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            $user = $results;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php require 'header.php' ?>

        <?php if(!empty($user)): ?>
            <br>Bienvenido. <?= $user['email'] ?>
            <br>Que bueno tenerte de Vuelta
            <a href="cerrar.php">
                Cerrar Seccion
            </a>
        <?php else: ?> 
            <h1>Por Favor Registrate o Inicia Seccion</h1>

            <a href="inicia.php">Inciar Seccion</a> o
            <a href="registro.php">Registrarme</a>
        <?php endif; ?>
    </body>
</html>