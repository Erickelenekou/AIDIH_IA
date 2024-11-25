<?php

    $host="localhost";
    $dbname="aidih_ia";
    $username="root";
    $password="";
    
    $pdo=new PDO ("mysql:host=$host; dbname=$dbname",$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations actuelles
    $sql = "SELECT id, nom, email FROM inscription WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $inscription = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['modifier'])) {
    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    // Mettre à jour l'utilisateur dans la base de données
    $sql = "UPDATE inscription SET nom = :nom, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("location:recuperer.php");
    } 
}
?>

<form action="modifier.php?id=<?php echo $id; ?>" method="post">
    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="<?php echo htmlspecialchars($inscription['nom']); ?>" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($inscription['email']); ?>" required>  
    <button type="submit" name="modifier">Modifier</button>
</form>