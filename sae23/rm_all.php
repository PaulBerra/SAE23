<?php
echo "<body>";

$pdo = sql_connect();
$sql = "CREATE TABLE IF NOT EXISTS `db_BERRA`.`interventions` (
    id INT(1) UNSIGNED AUTO_INCREMENT NOT NULL,
    `lieu` VARCHAR(50) DEFAULT NULL,
    `date` VARCHAR(50) DEFAULT NULL,
    `heure` VARCHAR(50) DEFAULT NULL,
    `type` VARCHAR(50) DEFAULT NULL,
    PRIMARY KEY (id)) ENGINE=MyISAM;";
$requete = $pdo->query($sql);
function script() {
        echo "<script>";
        echo "alert('Table supprimer -> redirection vers l\'accueil... ');";
        echo "function retour2() { window.location.replace('homepage.php'); console.log(' ! Redirection to homepage ! '); }"; 
        echo "retour2()";
        echo "</script>";
}
if (isset($_POST['id1'] )) {
    try  {
        //$requete = $pdo->query("SELECT * FROM interventions");
        $requete = $pdo->query("DROP TABLE interventions;"); 
        //$requete = $pdo->query($sql);
        script();
    }
    catch(Exception $e) { echo "Erreur " . $e->getMessage(); }
}

//drop de la table 'intervention' si clique
echo "<form action='' method='post'>";
echo "<button type='submit' id='id1' name='id1'> Supprimer toutes les interventions </button>";
?>