<?php

 session_start();

$non="";





$host = 'localhost';
$dbname = 'ec';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
 
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['name'])){$name = htmlentities($_POST['name']);}
    if(isset($_POST['pass'])){$pass = htmlentities($_POST['pass']);}



    $statement = $pdo->prepare('SELECT * FROM admin WHERE name = :name');
    $statement->bindValue(':name', $name);

    if ($statement->execute()) {
        $admins = $statement->fetch(PDO::FETCH_ASSOC);

if ($admins === false) {
    $non=1;
} else {

    if ((hash('sha512', $pass) === $admins['pass'])||(password_verify($pass, $admins['pass']))) {
        $_SESSION['name'] = $name;
        header('Location: admin.php');
        exit();

    } else {
        $non=1;
    }
}

    } else {
        echo 'Impossible de récupérer l\'utilisateur.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>


<div class="fstyle">
<form action="" id="auth" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="pass" name="pass" required><br><br>

        <input type="submit" value="Valider">
    </form>
    </div>



