<?php

$_SESSION=array();
$_COOKIE=array();
session_start();

function cbGetValue($array,$name,$default='') {
  if (isset($array[$name])) return $array[$name];
  else return $default;
}
function cbPrintf() {
  $args=func_get_args();
  $args[0].="\n";
  call_user_func_array('printf',$args);
}

function afficheLoginForm() {
  global $pdo;
  cbPrintf('<fieldset class="loginForm">');
  cbPrintf('<legend>Authentification</legend>');
  cbPrintf('<form action="%s" method="post" accept-charset="utf8">',$_SERVER['PHP_SELF']);
  cbPrintf('<table class="loginForm">');
  cbPrintf('<tr class="loginForm">');
  cbPrintf('<th class="loginForm">Utilisateur :</th>');
  $user=cbGetValue($_REQUEST,'user');
  cbPrintf('<td class="loginForm">');
  cbPrintf('<input type="text" name="user" value="%s"/>',$user);
  cbPrintf('</td>');
  cbPrintf('</tr>');
  cbPrintf('<tr class="loginForm">');
  cbPrintf('<th class="loginForm">Mot de passe :</th>');
  cbPrintf('<td class="loginForm">');
  cbPrintf('<input type="password" name="pass"/>');
  cbPrintf('</td>');
  cbPrintf('</tr>');
  cbPrintf('<tr class="loginForm">');
  cbPrintf('<th class="loginFormCenter" colspan="2">');
  cbPrintf("<input type='submit' value='Authentification'/>");
  cbPrintf('</th>');
  cbPrintf('</tr>');
  cbPrintf('</table>');
  cbPrintf('</form>');
  cbPrintf('</fieldset>');
}

function auth($user,$pass) {
    global $pdo;
  if ($user==='toto'&&$pass==='titi') {
    cbPrintf('<h2>Utilisateur %s authentifié !</h2>',$user);
    echo "<script> document.location = 'https://r207.borelly.net/~u22117288/SAE23/homepage.php' </script>";
    return true;
    
    

  }
  if ($user!='') {
    cbPrintf('<h2 style="color:red;">BAD PASSWORD for [%s] !!!</h2>',$user);
  }
  return false;
}


// include logout.php
$logout=cGetValue($_REQUEST,'logout');
if ($logout=='true') {
  session_destroy();
  $_SESSION=array();
  $home='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
  header('Location: '.$home);
  exit(1);
}

//include html-debut
cbPrintf('<!DOCTYPE html>');
cbPrintf('<html');
cbPrintf('<head>');
if (isset($title)) { cbPrintf('<title >%s</title>',$title); }
cbPrintf('<meta charset="utf8"/>');
cbPrintf('<link rel="stylesheet" href="login.css"/>');
cbPrintf('</head>');
cbPrintf('<body>');
//


// login.php
$auth=cbGetValue($_SESSION,'auth');
if ($auth!='ok') { // Pas de variable de session = pas identifié !
  $user=cbGetValue($_REQUEST,'user'); // Envoyé d'un formulaire
  $pass=cbGetValue($_REQUEST,'pass'); // Envoyé d'un formulaire
  if (auth($user,$pass)) {
    $_SESSION['auth']='ok'; // Sauvegarde dans la session
    $_SESSION['user']=$user; 
  } else {
    afficheLoginForm();
  }
}
// 
###########################################################
# Ici, on est authentifié !!!
###########################################################

$user = cbGetValue($_SESSION,'user');
$logout=cbGetValue($_REQUEST,'logout');
//cbPrintf('Utilisateur %s connecté <br>', $user);
if ($logout=='true') {
  session_destroy();
  $_SESSION=array();
  $home='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
  header('Location: '.$home);
  exit(1);
}

// get login, pass, mail
function regist_login() {
  echo "<div id=register_log";
  echo "<?php <form action='%s' method='get'>, htmlspecialchars($_SERVER['PHP_SELF']) ?>";
  echo "<p> login : <input type='text' name='login' id='login'/> </p>";
  if(isset($_GET['login'])){
      $login = htmlspecialchars($_GET['login']); 
 }else{
      $login = "";
}
return $login;
}

function regist_pass() {
  echo "<div id=register_pass";
  echo "<?php <form action='%s' method='get'>, htmlspecialchars($_SERVER['PHP_SELF']) ?>";
  echo "<p> password : <input type='text' name='passw' id='pass'/> </p>";
  if(isset($_GET['passw'])){
      $passw= htmlspecialchars($_GET['passw']); 
 }else{
      $passw = "";
}
return $passw;
}

function regist_mail() {
  echo "<div id=register_mail";
  echo "<?php <form action='%s' method='get'>, htmlspecialchars($_SERVER['PHP_SELF']) ?>";
  echo "<p> mail : <input type='text' name='mail' id='mail'/> </p>";
  if(isset($_GET['mail'])){
      $mail = htmlspecialchars($_GET['mail']); 
 }else{
      $mail = "";
}
return $mail;
}
$login = regist_login();
$passw = regist_pass();
$mail = regist_mail();

function add_user($login, $passw, $mail) {
  $sql = "CREATE TABLE IF NOT EXISTS `db_BERRA`.`users` (
    id INT(1) UNSIGNED AUTO_INCREMENT NOT NULL,
    `lieu` VARCHAR(50) DEFAULT NULL,
    `date` VARCHAR(50) DEFAULT NULL,
    `heure` VARCHAR(50) DEFAULT NULL,
    `type` VARCHAR(50) DEFAULT NULL,
    PRIMARY KEY (id)) ENGINE=MyISAM;
    INSERT INTO `db_BERRA`.`users` (`users`, `pass`, `mail`) VALUES ('$login', '$passw', '$mail');";
    return $sql;
}
add_user()

function sql_connect() {
$pdo=new PDO('mysql:host=localhost;dbname=db_BERRA;charset=UTF8','22117288','PaulPaul');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $pdo;
}
$pdo =GlobalSql_connect();
$pdo->query($sql);
?>
