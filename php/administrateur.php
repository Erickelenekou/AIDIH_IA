<?php
session_start();

// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    // Si l'utilisateur n'est pas admin ou non connecté, rediriger vers la page de login
    header('Location: connexion.php');
    exit;
}

// Contenu réservé aux administrateurs
echo "Bienvenue sur le tableau de bord administrateur!";
?>
