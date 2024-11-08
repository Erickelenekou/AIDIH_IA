<?php
 $host="localhost";
 $dbname="aidih_ia";
 $username="root";
 $password="";
 
 $conn=new PDO ("mysql:host=$host; dbname=$dbname",$username,$password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['envoyer'])) {
    $nom=htmlspecialchars($_POST['nom']);
    $mot_de_passe=sha1($_POST['mot_de_passe']);

      $sql="SELECT * FROM `inscription` WHERE nom=? AND mot_de_passe=?";
      $lui=$conn->prepare($sql);
      $lui->execute(array($nom,$mot_de_passe));

      if ($lui->rowCount()>0) {
        $_SESSION['nom']=$nom;
        $_SESSION['mot_de_passe']=$mot_de_passe;
        header("location:../html/acceuil.html");
      } else {
        echo"<div class='text-center'>";
        echo "nom ou mot de passe incorrect. Veuillez ressayer.";
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
    <title>connexion</title>
    <link rel="stylesheet" href="../css/connexion.css">
</head>
<body>
    <div class="container" id="bloc">
        <div class="row">
            <div class="container col-6" id="bloc_1">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-7 " id="bloc_12">
                        <div id="bloc_12_contenu">
                            <div class="text-center">
                                <h2>Connectez-vous</h2>
                                <span>Bienvenue</span>
                            </div>
                            <form action="" method="post">
                                <div>
                                    <input type="text" class="form-control" name="nom" placeholder="Nom utilisateur" required>
                                </div>
                                <div>
                                    <input type="password" class="form-control" name="mot_de_passe" placeholder="Mot de passe" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="envoyer" class="col col-12 rounded-5">Se Connecter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 20px;">
                    <span>Nouveau?</span>
                     <a href="inscription.php">Inscrivez-vous</a>
                </div> 
            </div>
            <div class="col-6 text-center" id="bloc_2">
                <h2>Bienvenue sur notre site!</h2>
                <div id="explorez">
                    <span>Explorez nos contenus et decrouvez ce que <br>
                         nous avons à offrire 
                    </span>
                </div>
                <div id="bloc_23" >
                    <a href="inscription.php">S'inscrire</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>