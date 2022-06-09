
<?php
print("<center><h1> remove alert page </h1></center>");
include("rm_all.php");


//ouvre la connection avec la bdd phpmyadmin
function sql_connect() {
$pdo=new PDO('mysql:host=localhost;dbname=db_BERRA;charset=UTF8','22117288','PaulPaul');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $pdo;
}


print('<script>');
echo "function retour2() { location.replace('homepage.php'); console.log(' ! Redirection to homepage ! '); alert(this.location); }";
print('</script>');
echo "<p><button id='1' onClick='retour2()'> Retour </button></p>";

function get_current_alert() {
   
    //$last = "SELECT LAST_INSERT_ID(id) FROM interventions;";
    //$button = "<button id='modifier' onClick='alert(1)'> modifier </button>";

    $pdo = sql_connect();
    $last = $pdo->query('SELECT MAX(id) FROM interventions;')->fetch(PDO::FETCH_NUM)[0];
    $first = $pdo->query('SELECT MIN(id) FROM interventions;')->fetch(PDO::FETCH_NUM)[0];
    //$last = id de la bdd le plus haut pour pouvoir faire la boucle
    //$first = plud petit id de la table
    print("<center> <pre> Lieu d'intervention \t   Date \t  Heure \t Type d'intervention \t ID </pre> </center>");
    echo "<hr>";
    foreach (range($first, $last) as $id) {
        $alerte = $pdo->query("SELECT * FROM `interventions` WHERE id=$id;")->fetch(PDO::FETCH_ASSOC);
        $compteur = 0;
        echo "<center><pre>";
        foreach( $alerte as $retour) {
            if ( $retour != $id) {
                //on affiche les alertes ici
                print($retour); print("\t"); print("|"); print("\t");
                }
               
                //on incremente le compteur
                $compteur += 1;
            if( $compteur == 5) {//si jamais on est arrive a la fin de la ligne de la bdd (id+lieu+date+type+heure=5)
                echo $id;
                //trait et saut de ligne
                echo "<br>";
                echo "<hr>";
                //compteur remis a zero
                $compteur = 0;
            }
        }
    }
}


echo "
<form method='post' enctype='application/x-www-form-urlencoded'>

<input type='hidden' name='supp' value='supprimer' />
<input type='submit' value='Supprimer une alerte'  /> </form>";
echo "";
 if(isset($_POST["supp"]))
{
                    echo "<form method='get'> <input type='text' name='identifiant'>
                    <input type='hidden' name='txtsup' value='txtsupprimer' />
                    Entrez ID de alerte a supprimer
                    <input type='submit' value='supprimer' /> </form>";
                    
                    //$pdo->query("DELETE FROM `interventions` WHERE `id`=$id;");
  
}
if(isset($_GET["txtsup"]))
{
                        $id = $_GET['identifiant'];
                        $pdo->query("DELETE FROM `interventions` WHERE `id`=$id;");
                        header('Location: remove_alert.php');
}
                


get_current_alert();

echo "<center> <p> <form name='x' method='post' action='auth/log.php'>";

echo "<input type='submit' value='logout'>";

echo "</form></p> </center>";


//boucle qui : 
//recupere la liste des alertes
// bouton remove ou modify

?>