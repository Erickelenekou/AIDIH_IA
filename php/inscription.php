<?php
// Connexion à la base de données
$host="localhost";
$dbname="aidih_ia";
$username="root";
$password="";

$pdo=new PDO ("mysql:host=$host; dbname=$dbname",$username,$password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Initialisation des variables
$email = $password = $confirm_password = '';
$email_err = $password_err = $confirm_password_err = '';

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom=htmlspecialchars($_POST['nom']);
    $email=htmlspecialchars($_POST['email']);
    $mot_de_passe=sha1($_POST['mot_de_passe']);
    $role=htmlspecialchars($_POST['role']);

    // Validation de l'email
    if (empty(trim($_POST["email"]))) {
        $email_err = "L'email est requis.";
    } else {
        $email = trim($_POST["email"]);

        // Vérification si l'email existe déjà dans la base de données
        $sql = "SELECT id FROM utilisateur WHERE email = :email";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $email_err = "Cet email est déjà utilisé.";
                }
            } else {
                echo "Une erreur est survenue. Veuillez réessayer plus tard.";
            }
        }
    }

    // Validation du mot de passe
    if (empty(trim($_POST["mot_de_passe"]))) {
        $password_err = "Le mot de passe est requis.";
    } elseif (strlen(trim($_POST["mot_de_passe"])) < 6) {
        $password_err = "Le mot de passe doit comporter au moins 6 caractères.";
    } else {
        $password = trim($_POST["mot_de_passe"]);
    }


    // Validation de la confirmation du mot de passe
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Veuillez confirmer votre mot de passe.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password !== $confirm_password) {
            $confirm_password_err = "Les mots de passe ne correspondent pas.";
        }
    }


    // Si aucune erreur, inscrire l'utilisateur
    if (empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Hashage du mot de passe
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // Inscription dans la base de données
        $sql = "INSERT INTO utilisateur (nom, email, mot_de_passe, role) VALUES (:nom,:email, :mot_de_passe,:role )";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":mot_de_passe", $password_hashed, PDO::PARAM_STR);
            $stmt->bindParam(":role", $role, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Inscription réussie!";
            } else {
                echo "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
            }
        }
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
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col col-8" >
                                    <div >
                                        <input  type="text" name="nom" class="form-control" required placeholder="Nom utilisateur">
                                    </div>
                                    <div >
                                        <input type="email" name="email" class="form-control" required placeholder="Email">
                                        <span><?php echo $email_err; ?></span>
                                    </div>
                                    <div >
                                        <input type="password"  name="mot_de_passe" class="form-control" required placeholder="Mot de passe">
                                        <span><?php echo $password_err; ?></span>
                                        <input type="password"  name="confirm_password" class="form-control" required placeholder="Confirmer le mot de passe">
                                        <span><?php echo $confirm_password_err; ?></span>
                                    </div>
                                    <div>
                                        <select class="form-control" name="role" id="role" required>
                                            <option value="">Choisissez votre role</option>
                                            <option value="user">Utilisateur</option>
                                            <option value="admin">administrateur</option>
                                        </select>
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