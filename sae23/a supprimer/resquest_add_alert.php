<?php


$hote = 'localhost'; // Adresse du serveur 
$login = '22117288'; // Login 
$pass = 'PaulPaul'; // Mot de passe 
$base = 'db_BERRA'; // Base de données à utiliser 
 
// On se connecte à la base de données 
mysql_connect($hote, $login, $pass); 
 
// On selectionne la base de données souhaitée 
mysql_select_db($base); 

echo "resquest done"
exit(0);

?>