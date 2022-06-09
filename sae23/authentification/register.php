<?php

function cbPrintf() {
  $args=func_get_args();
  $args[0].="\n";
  call_user_func_array('printf',$args);
}
// ------------------------------------------------------------------------------------------------------------------------------------------------------------
//fonction alerte 
function alert_champsvides($arg) {
    echo "<DOCTYPE HTML>";
    echo "<script>";
    printf("alert('%s')", $arg);
    echo "</script>";
    echo "</DOCTYPE HTML>";
}
?>

<DOCTYPE HTML>

<h1 class='titre'> Registering page </h1>


<div id='formulaire'>
<?php printf("<form action='%s' method='get'>", htmlspecialchars($_SERVER['PHP_SELF'])); ?>
<div class='login_box'>     <p> Login : <input type='text' name='login' id='login'/> </p>     </div>
<div class='passw_box'>  <p> Password : <input type='text' name='passw'/> </p>     </div>
<div class='mail_box'>  <p> Mail : <input type='text' name='mail'/> </p> </div>
<div class='submit_button'>  <p> <input type='submit' value='Confirmer'> </p> </div>
</form>
</div>

<div class='btn_retour'>
<p><button id='1' onClick='retour2()'> Retour </button></p>
</div>

<script>
function retour2() { location.replace('https://r207.borelly.net/~u22117288/SAE23/auth/log.php'); console.log(' ! Redirection to homepage ! '); alert(this.location); };
</script>

</DOCTYPE>

<?php

//ouverture de ka connection avec la bdd phpmyadmin
function sql_connect() {
$pdo=new PDO('mysql:host=localhost;dbname=db_BERRA;charset=UTF8','22117288','PaulPaul');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $pdo;
}

// ------------------------------------------------------------------------------------------------------------------------------------------------------------
//filtrage de certains caracteres pour eviter l'injection de js
if(isset($_GET['login'])){
      $login = htmlspecialchars($_GET['login']); 
 }else{
      $login = "";
 }

if(isset($_GET['passw'])){
      $passw = sha1(htmlspecialchars($_GET['passw'])); 
 }else{
      $passw = "";
 }

if(isset($_GET['mail'])){
      $mail = htmlspecialchars($_GET['mail']); 
 }else{
      $mail = "";
}


// ------------------------------------------------------------------------------------------------------------------------------------------------------------
//fonction en charge d'alerter si champs vide, ou retourne la requete sql avec les bons arguments

function add_user($login, $passw, $mail) {
    if( ($login=='' or $passw=='' or $mail=='')){
      $arg='Veuillez remplir tous les champs';
      alert_champsvides($arg);
      continue;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `db_BERRA`.`users` (
      id INT(1) UNSIGNED AUTO_INCREMENT NOT NULL,
      `login` VARCHAR(50) DEFAULT NULL,
      `pass` VARCHAR(50) DEFAULT NULL,
      `mail` VARCHAR(50) DEFAULT NULL,
      PRIMARY KEY (id)) ENGINE=MyISAM;
      INSERT INTO `db_BERRA`.`users` (`login`, `pass`, `mail`) VALUES ('$login', '$passw', '$mail');";
      return $sql;
  }

$sql = add_user($login, $passw, $mail);
$pdo = sql_connect();
$pdo->query($sql);
?>