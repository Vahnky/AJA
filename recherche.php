<?php

$host = 'localhost';
$dbname = 'EC';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);



$recherche = $_GET['client'];

$sql = "SELECT * FROM client WHERE name LIKE '$recherche%'";

$result = $pdo->query($sql);
$number_of_rows = $result->rowCount();

if ($number_of_rows > 0) {

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "ID du client: " . $row["id"] . " - Nom du Client: " . $row["name"] . " - Balance: " . $row["balance"] . "<br>" ;
    }
} else {
    echo "<div style='font-size:20px;text-align:center;margin-top:10px'>Aucun résultat</div>";
}


$pdo=null;}catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    exit();
}


