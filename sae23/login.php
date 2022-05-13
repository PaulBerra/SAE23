<?php
session_start();
include('logout.php');
include('html-debut.php');
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
cbPrintf('Utilisateur %s connecté <br>', $user);
cbPrintf('<a href="%s?logout=true">Déconnecter %s </a><br/>', $_SERVER['PHP_SELF'], $user );
?>
