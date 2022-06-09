<DOCTYPE HTML>

<link rel='stylesheet' type='text/css' href='index.css'>


<h1 class='titre'> add alert page </h1>


<div id='formulaire'>
  <?php printf("<form action='%s' method='get'>", htmlspecialchars($_SERVER['PHP_SELF'])); ?>
  <p>Lieu d'intervention : <input type='text' name='lieu' id='lieuf'/></p>
  <p>Date de l'intervention : <input type='text' name='date' /></p>
  <p>Heure de l'intervention : <input type='text' name='heure' /></p>
  <p>Type d'intervention : <input type='text' name='type' /></p>
  <p><input type='submit' value='Confirmer'></p>
  </form>
</div>

<div class='btn_retour'>
<p><button id='1' onClick='retour2()'> Retour </button></p>
</div>

<script>
function retour2() { location.replace('homepage.php'); console.log(' ! Redirection to homepage ! '); alert(this.location); };
</script>


</DOCTYPE>

<?php
error_reporting (E_ALL ^ E_NOTICE);

//ouverture de ka connection avec la bdd phpmyadmin
function sql_connect() {
$pdo=new PDO('mysql:host=localhost;dbname=db_BERRA;charset=UTF8','22117288','PaulPaul');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $pdo;
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------------
//filtrage de certains caracteres pour eviter l'injection de js
if(isset($_GET['lieu'])){
      $lieu = htmlspecialchars($_GET['lieu']); 
 }else{
      $lieu = "";
 }

if(isset($_GET['date'])){
      $date = htmlspecialchars($_GET['date']); 
 }else{
      $date = "";
 }

if(isset($_GET['heure'])){
      $heure = htmlspecialchars($_GET['heure']); 
 }else{
      $heure = "";
}

if(isset($_GET['type'])){
      $type = htmlspecialchars($_GET['type']); 
 }else{
      $type = "";
}
// ------------------------------------------------------------------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------------------------------------------------------------------
///alert en cas de champs vides
function alert_champsvides($arg) {
    echo "<DOCTYPE HTML>";
    echo "<script>";
    printf("alert('%s')", $arg);
    echo "</script>";
    echo "</DOCTYPE HTML>";
}
// ------------------------------------------------------------------------------------------------------------------------------------------------------------


// ------------------------------------------------------------------------------------------------------------------------------------------------------------
//fonction qui fait passer la requete a la bdd si aucuns champs vides
function add_sql($lieu, $date, $heure, $type) {
  if( ($lieu=='' or $date=='' or $heure=='' or $type=='')){
    $arg='Veuillez remplir tous les champs';
    alert_champsvides($arg);
    continue;
  }
  $sql = "CREATE TABLE IF NOT EXISTS `db_BERRA`.`interventions` (
    id INT(1) UNSIGNED AUTO_INCREMENT NOT NULL,
    `lieu` VARCHAR(50) DEFAULT NULL,
    `date` VARCHAR(50) DEFAULT NULL,
    `heure` VARCHAR(50) DEFAULT NULL,
    `type` VARCHAR(50) DEFAULT NULL,
    PRIMARY KEY (id)) ENGINE=MyISAM;
    INSERT INTO `db_BERRA`.`interventions` (`lieu`,`date`, `heure`, `type`) VALUES ('$lieu','$date','$heure','$type');";
  return $sql; 
}
// ------------------------------------------------------------------------------------------------------------------------------------------------------------
echo "<DOCTYPE HTML> <center> <p> <form name='x' method='post' action='auth/log.php'>";

echo "<input type='submit' value='logout'>";

echo "</form></p> </center> </DOCTYPE HTML>";

$sql = add_sql($lieu, $date, $heure, $type);
$pdo = sql_connect();
$pdo->query($sql);
?>