
<?php
 $host="localhost";
 $dbname="aidih_ia";
 $username="root";
 $password="";
 
 $conn=new PDO ("mysql:host=$host; dbname=$dbname",$username,$password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['envoyer'])) {
    $image=htmlspecialchars($_POST['image']);

    $insertStmt = $conn->prepare("INSERT INTO image (image) VALUES (:image)");
    $insertStmt->bindParam(':image', $image);
    $insertStmt->execute();

  }
?> 

<?php

    $sql = "SELECT  image FROM image";
    $stmt = $conn->query($sql);

    $inscription = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<table border="1">';
    echo '<tr><th>ID</th><th>image</th><th>Actions</th></tr>';
    foreach ($inscription as $inscription) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($inscription['id']) . '</td>';
        echo '<td>' . htmlspecialchars($inscription['image']) . '</td>';
        echo '<td>
                <a href="?id=' . $inscription['id'] . '">Modifier</a> | 
                <a href="supprimer.php?id=' . $inscription['id'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\')">Supprimer</a>
            </td>';
        echo '</tr>';
    }
    echo '</table>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

   <form action="" method="post">
        <div>
            <input type="file" name="image">
        </div>
        <div>
        <input type="submit" name="envoyer">
        </div>
    </form>

</body>
</html>