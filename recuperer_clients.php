<?php

$dsn = 'mysql:host=localhost;dbname=ec';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);



    $sql = 'SELECT id, name, statut, balance FROM client';
    $stmt = $pdo->query($sql);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);


    header('Content-Type: application/json');
    echo json_encode($clients);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
