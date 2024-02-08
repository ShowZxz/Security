<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'security';


try {
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configurer PDO pour lever des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Autres configurations PDO si nécessaire

} catch (PDOException $e) {
    // En cas d'échec de connexion, afficher l'erreur
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

