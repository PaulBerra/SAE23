<?php
###############################################################################
###############################################################################
  function auth($user,$pass) {
    global $pdo;
  if (sha1($user)==='522b276a356bdf39013dfabea2cd43e141ecc9e8'&&sha1($pass)==='7110eda4d09e062aa5e4a390b0a572ac0d2c0220') {
    cbPrintf('<h2>Utilisateur [%s] authentifié !</h2>',$user);
    return true;
  }
  if ($user!='') {
    cbPrintf('<h2 style="color:red;">BAD PASSWORD for [%s] !!!</h2>',$user);
  }
  return false;
}
?>
