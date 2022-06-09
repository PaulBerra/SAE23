<?php

$_SESSION=array();
$_COOKIE=array();
session_start();

function sql_connect() {
$pdo=new PDO('mysql:host=localhost;dbname=db_BERRA;charset=UTF8','22117288','PaulPaul');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $pdo;
}

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
  $auth=cbGetValue($_SESSION,'auth');
  if ($auth!='ok') {
  cbPrintf("<a href ='https://r207.borelly.net/~u22117288/SAE23/auth/register.php'> Register </a>");
  }
  cbPrintf('</form>');
  cbPrintf('</fieldset>');
}

$user=cbGetValue($_REQUEST,'user');
$pass=cbGetValue($_REQUEST,'pass');
function id_pass($user,$pass) {
  $pdo = sql_connect();
  $req_id = $pdo->query("SELECT id FROM `users` WHERE login='$user' AND pass='$pass'");
  $reponse = $req_id->fetch();
  $reponse_id=$reponse['id'];
  echo 'id :';
  var_dump($reponse_id);
  echo '<br>';
  return $reponse_id;
}


function good_pass($reponse_id) {
  $pdo = sql_connect();
  $req_passw = $pdo->query("SELECT pass FROM `users` WHERE id='$reponse_id'");
  $reponse = $req_passw->fetch();
  $reponse_good_pass = $reponse['pass'];
  echo 'pass :';
  var_dump($reponse_good_pass);
  echo '<br>';
  return sha1($reponse_good_pass);
}

function good_login($reponse_id) {
  $pdo = sql_connect();
  $req_login = $pdo->query("SELECT login FROM `users` WHERE id='$reponse_id'");
  //var_dump($req_login);
  $reponse = $req_login->fetch();
  $reponse_good_login=$reponse['login'];
  echo 'login :';
  var_dump($reponse_good_login);
  echo '<br>';
  return sha1($reponse_good_login);
}
$reponse_id = id_pass($user,$pass);
$reponse_good_pass = good_pass($reponse_id);
$reponse_good_login = good_login($reponse_id);

function auth($user,$pass,$reponse_good_login,$reponse_good_pass) {
    global $pdo;
    cbPrintf('sha1($user) : %s', sha1($user));
    cbPrintf('sha1($pass) : %s', sha1($pass));
    cbPrintf('reponse_good_login : %s', $reponse_good_login);
    cbPrintf('reponse_good_pass : %s', $reponse_good_pass);
  echo "<script> sessionStorage.clear() </script>";
  if (sha1($user)===$reponse_good_login && sha1($pass)===$reponse_good_pass) {
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
$logout=cbGetValue($_REQUEST,'logout');
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
  if (auth($user,$pass,$reponse_good_login,$reponse_good_pass)) {
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

?>
