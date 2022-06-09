<!DOCTYPE HTML> 
<center> 






<script>

//request_add() -> affiche la page lier
//Add_alerte() -> log des requete + appel request_add()

function request_add() { 
    window.location.replace('add_alert.php');
}
function request_remove() { 
    window.location.replace('remove_alert.php');
}

function add_alerte() {
    console.log(' ! Redirection to alert adding webpage ! ');
    request_add();
}

function remove_alerte() {
    console.log(' ! Redirection to alert removing webpage ! ');
    request_remove();
}


</script>
<center> 
<h1 class='titre'> homepage </h1>

<p><button onclick='add_alerte()'> Add Alert </button></p>
<p><button onclick='remove_alerte()'> Remove Alert </button></p> </center>
<p> 

<form name='x' method='post' action='' >
<input type='submit' value='logout' action="header('Location : ' homepage.php?logout=true)" >
</form></p>

</center> 

</DOCTYPE HTML>
<?php


function cbGetValue($array,$name,$default='') {
  if (isset($array[$name])) return $array[$name];
  else return $default;
}
$etat = CbGetValue($_POST, 'logout');
var_dump($etat);
function cbPrintf() {
  $args=func_get_args();
  $args[0].="\n";
  call_user_func_array('printf',$args);
}

function disconnect() {
    $logout=cbGetValue($_REQUEST,'logout');
if ($logout=='true') {
  session_destroy();
  $_SESSION=array();
  $home='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
  header('Location: '.$home);
  // var_dump($_SESSION);
  exit(1);
}
}

$logout=cbGetValue($_REQUEST,'logout');
if ($logout=='true') {
  session_destroy();
  $_SESSION=array();
  $home='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
  header('Location: '.$home);
  exit(1);
}
//cbPrintf('Utilisateur %s connecté <br>', $user);

//---------------------------------------------------------------------------------
// disconnect



//---------------------------------------------------------------------------------


?>