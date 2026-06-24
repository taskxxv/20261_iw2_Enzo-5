<?php
    $host = 'localhost';
    $db_name = 'dbcontatos';
    $port = '3307';
    $usuario = 'root';
    $senha = 'usbw';
    $endereco = "mysql:host=$host;dbname=$db_name;port=$port";
    try {
        $conn = new PDO($endereco, $usuario, $senha);
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, __DIR__  . "/erros.log");
        echo 'Erro conecxao!';
    }
?>