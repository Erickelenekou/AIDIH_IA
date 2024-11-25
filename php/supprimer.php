<?php

$host="localhost";
    $dbname="aidih_ia";
    $username="root";
    $password="";
    
    $pdo=new PDO ("mysql:host=$host; dbname=$dbname",$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //supprimer les informations
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM inscription WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "Utilisateur supprimé avec succès.";
    } 
}
?>