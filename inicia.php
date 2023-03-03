<?php

  session_start();

  if (isset($_SESSION['iduser'])) {
    header('Location: /php-inicia');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['clave'])) {
    $records = $conn->prepare('SELECT iduser, email, clave FROM user WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $mensaje = '';

    if (count($results) > 0 && password_verify($_POST['clave'], $results['clave'])) {
      $_SESSION['iduser'] = $results['iduser'];
      header("Location: /php-inicia");
    } else {
      $mensaje = 'Clave Incorrecta';
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Secciont</title>
    <link rel="stylesheet" href="style.css">
</head>
  <body>
      <?php require 'header.php'; ?>
      <?php if(!empty($mensaje)): ?>
        <p> <?= $mensaje ?></p>
      <?php endif; ?>

      <h1>Iniciar Seccion</h1>
      <span>  ó <a href="registro.php">registrate</a></span>

      <form action="inicia.php" method="POST" >
          <input type="text" name="email" placeholder="Ingresa tu Email" required>
          <input type="password" name="clave" placeholder="Ingresa Tu Clave" required >
          <button class="boton" type="submit" >entrar</button>
      </form>
  </body>
</html>