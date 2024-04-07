<?php

$serveur = 'localhost';
$utilisateur = 'root';
$motDePasse = '';
$baseDeDonnees = 'ec'; 
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);


if ($connexion->connect_error) {
    die('Erreur de connexion à la base de données : ' . $connexion->connect_error);
}


$balanceFiltre = $_GET['balance'];


$sql = "SELECT id, name, statut, balance FROM client WHERE ";
if ($balanceFiltre === 'positive') {
    $sql .= "balance > 0";
} elseif ($balanceFiltre === 'negative') {
    $sql .= "balance < 0";
} else {

    $sql .= "1"; 
}


$resultat = $connexion->query($sql);


if ($resultat->num_rows > 0) {
    while ($row = $resultat->fetch_assoc()) {
        echo "<p>"."ID : " . $row['id'] . " | Nom : " . $row['name'] . " | Statut : " . $row['statut'] . " | Balance : " . $row['balance'] . "</p>"."<br>";
    }
} else {
    echo "Aucun client trouvé.";
}


$connexion->close();

