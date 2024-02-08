<?php
/* Template Name: PageProfile */

get_header(); ?>

<div style="text-align: center;">

    <?php
    // Vérifiez si l'utilisateur est connecté
    session_start();
    if (isset($_SESSION['pseudo']) && isset($_SESSION['code'])) {
        echo "<h2>Profil de " . esc_html($_SESSION['pseudo']) . "</h2>";
        echo "<p>Pseudo: " . esc_html($_SESSION['pseudo']) . "</p>";
        echo "<p>Code généré: " . esc_html($_SESSION['code']) . "</p>";
    } else {
        echo "Aucune information de profil disponible.";
    }
    ?>

</div>

<?php get_footer(); ?>
