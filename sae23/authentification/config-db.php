<?php
$pdo=new PDO('mysql:host=localhost;dbname=db_BERRA;charset=UTF8','22117288','PaulPaul');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
