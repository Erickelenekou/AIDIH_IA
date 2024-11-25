<?php
session_start();

// Vérifier si l'utilisateur est connecté et a le rôle d'utilisateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    // Si l'utilisateur n'est pas connecté ou n'a pas le bon rôle, rediriger vers la page de login
    header('Location: connexion.php');
    exit;
}

// Contenu réservé aux utilisateurs
echo "Bienvenue sur le tableau de bord utilisateur!";
?>
