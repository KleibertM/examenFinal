<?php 
    require 'database.php';

    $mensaje = '';

    if (!empty($_POST['email']) && !empty($_POST['clave'])) {
        $sql = "INSERT INTO user (email, clave) VALUES (:email, :clave)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
        $stmt->bindParam(':clave', $clave);

        if ($stmt->execute()) {
            $mensage = 'Usuario Creado Satisfatoriamente';
        } else {
            $mensaje = 'Lo siento, hubo un ERROr';
        }       
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Final</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require 'header.php'?>
    
    <?php if(!empty($mensaje)): ?>
        <p> <?= $mensaje ?> </p>
    <?php endif; ?>

    <h1>Registrate</h1>
    <span>o <a href="inicia.php">Inicia Seccion</a></span>
    
    <form action="registro.php" method="POST">
        <input type="text" name="email" placeholder="Ingresa tu Email" required>
        <input type="password" name="clave" placeholder="Ingresa Tu Clave" required >
        <button class="boton" type="submit" >registrarme</button>
    </form>
</body>
</html>