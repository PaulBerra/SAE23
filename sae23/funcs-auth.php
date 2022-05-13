<?php
###############################################################################
###############################################################################


  function auth($user,$pass) {
    global $pdo;
  if (sha1($user)==='0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c'&&sha1($pass)==='f7e79ca8eb0b31ee4d5d6c181416667ffee528ed') {
    cbPrintf('<h2>Utilisateur [%s] authentifié !</h2>',$user);
    return true;
  }
  if ($user!='') {
    cbPrintf('<h2 style="color:red;">BAD PASSWORD for [%s] !!!</h2>',$user);
  }
  return false;
}
?>
