<?php
 $host="localhost";
 $dbname="aidih_ia";
 $username="root";
 $password="";
 
 $conn=new PDO ("mysql:host=$host; dbname=$dbname",$username,$password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom=htmlspecialchars($_POST['nom']);
    $email=htmlspecialchars($_POST['email']);
    $mot_de_passe=sha1($_POST['mot_de_passe']);
    
    
    $stmt = $conn->prepare("SELECT * FROM inscription WHERE mot_de_passe = :mot_de_passe");
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
       
        echo"<div class='text-center'>";
        echo "Cet mot de passe est déjà utilisé. Veuillez en choisir un autre.";
    } else {
        
        $insertStmt = $conn->prepare("INSERT INTO inscription (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)");
        $insertStmt->bindParam(':nom', $nom);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->bindParam(':mot_de_passe', $mot_de_passe);
        $insertStmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <title>inscription</title>
    <link rel="stylesheet" href="../css/inscription.css">
</head>
<body>
    <section>
        <div class="container " id="bloc">
            <div class="row">
                <div class="col-6 ">
                    <div class="container border " id="bloc_1"  >
                        <div id="bloc_11">
                            <div class="text-center">
                                <h2>Inscrivez-vous</h2>
                                <span>Bienvenue</span>
                            </div>
                            <div class="container row" id="form">
                                <div class="col col-2"></div>
                                <form action="" method="post" class="col col-8" >
                                    <div >
                                        <input  type="text" name="nom" class="form-control" required placeholder="Nom utilisateur">
                                    </div>
                                    <div >
                                        <input type="email" name="email" class="form-control" required placeholder="Email">
                                    </div>
                                    <div >
                                        <input type="password"  name="mot_de_passe" class="form-control" required placeholder="Mot de passe">
                                    </div>
                                    <div >
                                        <button type="submit" name="envoyer" class=" col col-12 rounded-5">S'Inscrire</button>
                                    </div>
                                </form>
                            </div>
                            <div class="text-center">
                                <span>Déjà inscrit(e)?</span>
                                 <a href="connexion.php">Connectez-vous</a>
                            </div> 
                        </div>
                    </div>
                </div>

                <div class="col-6" id="bloc_2">
                    <div class="text-center" id="bloc_22">
                        <h2>Bienvenue sur notre plateforme !</h2>
                        <div id="nous_sommes">
                            <span>Nous sommes ravis de vous accueillir. Pour <br>
                                commencer votre aventure avec nous:
                            </span>
                        </div>
                    </div>
                    
                    <div id="bloc_23" >
                       <a href="connexion.php">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>