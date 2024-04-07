<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: connexion.php');
    exit();
}


echo "<p>"."Bienvenue" . " " . $_SESSION['name']."</p>";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin</title>


<div class="fstyle">
    <h2>Formulaire client</h2>

<form action="admin.php" id="clientForm" method="post">

    <label>Choisissez une action :</label>
    <input type="radio" id="creer" name="action" value="creer">
    <label for="creer">Créer</label>

    <input type="radio" id="modifier" name="action" value="modifier">
    <label for="modifier">Modifier</label>

    <input type="radio" id="supprimer" name="action" value="supprimer">
    <label for="supprimer">Supprimer</label>

    <br>
    <label for="NomClient">Nom du client :</label>
    <input type="text" id="NomClient" name="NomClient" required><br>

    <div id="prenomBalanceFields">

    <label for="Prestation">Statut de la prestation :</label>
    <input type="text" id="Prestation" name="Prestation" ><br>

    <label for="Balance">Balance :</label>
    <input type="number" id="Balanc" name="Balance" ><br>

    </div>

    

    <input class="dd" type="submit" value="Enregistrer" name="Enregistrer">
</form>
</div>


 <div id="result"></div>





<?php

$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "EC";

$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);


if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}


if(isset($_POST["action"])){$action = $_POST["action"];}
if(isset($_POST["NomClient"])){$nomClient = $_POST["NomClient"];}
if(isset($_POST["Prestation"])){$prestation = $_POST["Prestation"];}
if(isset($_POST["Balance"])){$balance = $_POST["Balance"];}


if(isset($_POST["action"])){if ($action === "creer") {
    $requete = "INSERT INTO client (name, statut, balance) VALUES ('$nomClient', '$prestation', $balance)";
    if ($connexion->query($requete) === TRUE) {
        echo "Client créé avec succès !";
    } else {
        echo "Erreur lors de la création du client : " . $connexion->error;
    }
}}

if(isset($_POST["action"])){if ($action === "modifier") {

    $requete = "UPDATE client SET Statut = '$prestation', balance ='$balance' WHERE name = '$nomClient'";
    if ($connexion->query($requete) === TRUE) {
        echo "Client mis à jour avec succès !";
    } else {
        echo "Erreur lors de la mise à jour du client : " . $connexion->error;
    }
}}


if(isset($_POST["action"])){if ($action === "supprimer") {

    $requete = "DELETE FROM client WHERE name = '$nomClient'";
    if ($connexion->query($requete) === TRUE) {
        echo "Client supprimé avec succès !";
    } else {
        echo "Erreur lors de la suppression du client : " . $connexion->error;
    }
}}



$connexion->close();
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>