<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifiant = $_POST["identifiant"];
    $password = $_POST["mot_de_passe"];



    if (isset($_POST["valider"])) {

        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = :identifiant");
        $stmt->bindParam(':identifiant', $identifiant);
        $identifiant_safe = htmlspecialchars($identifiant, ENT_QUOTES, 'UTF-8');
        $stmt->execute();

        // résultat
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashed_password = $user['password'];
            if (password_verify($password, $hashed_password)) {

                
                echo "<div class='success-message'>Vous êtes connecté</div>";
            }
        } else {


            echo "<div class='error-message'>Erreur. Recommencez</div>";

        }

    } elseif (isset($_POST["ajout_compte"])) {
        $identifiant = $_POST["identifiant"];
        $password = $_POST["mot_de_passe"];

        $identifiant  = trim($identifiant );
        
        // mes conditions de mdp

        if (strlen($password) < 8) {
            echo "Erreur  : Le mot de passe doit avoir au moins 8 caractères.";
        } elseif (!preg_match("/[A-Z]/", $password)) {
            echo "Erreur  : Le mot de passe doit contenir au moins une lettre majuscule.";
        } elseif (!preg_match("/[0-9]/", $password)) {
            echo "Erreur  : Le mot de passe doit contenir au moins un chiffre.";
        }
        elseif (strlen($nom_utilisateur) < 3 || strlen($nom_utilisateur) > 50) {
            echo "Erreur identifian : Identifiant trop court ou trop long"."<br/>";
        } else {


            // les verif
            $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = :identifiant");
            $stmt->bindParam(':identifiant', $identifiant);
            $stmt->execute();
    
            // Résultat
            $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($existing_user) {
                echo "Erreur lors de l'inscription : Identifiant ou mot de passe déjà utilisé !";
            } else {

                // hash du mot de passe 
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO utilisateurs (nom_utilisateur, password) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$identifiant, $hashed_password]);
                echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
            }
        }
    }
}

?>

<!-- Formulaire Sécurisé -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sécuriser</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div style="text-align: center;">
        <form action="inscription.php" method="post">
            <h1>Login de SINSEAU Lilian</h1>
            <img src="logo.png" alt="Logo" style="width: 100px; height: 100px;">
            <div class="input-box">
                <input type="text" name="identifiant" placeholder="Identifiant" required>
            </div>

            <div class="input-box">
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            </div>

            <div class="input-box">
                <label><input type="reset" value="Reset" /></label>
                <label><input type="submit" name="valider" value="Valider"></label>
                <label><input type="submit" name="ajout_compte" value="Ajout Compte"></label>
            </div>
        </form>
    </div>

    <script>

    </script>
</body>

</html>