<?php
    $server = 'localhost';
    $username = 'root';
    $clave = '';
    $database = 'exanweb';
    try {
        $base = new PDO("mysql:host=$server; dbname=$database;", $username, $clave);
    }catch (PDOException $e ) {
        die('Error de  Conexion'.$e->getMessage());
    }
?>