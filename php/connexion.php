<?php
session_start();  // Démarre la session pour utiliser $_SESSION

// Connexion à la base de données (ajustez les paramètres de connexion selon votre environnement)
    $host="localhost";
    $dbname="aidih_ia";
    $username="root";
    $password="";
    
    $pdo=new PDO ("mysql:host=$host; dbname=$dbname",$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = trim($_POST['email']);
    $mot_de_passe = trim($_POST['mot_de_passe']);

    // Préparer la requête pour récupérer l'utilisateur par son email
    $stmt = $pdo->prepare("SELECT id, email, mot_de_passe, role FROM utilisateur WHERE email = :email LIMIT 1");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Vérifier si l'utilisateur existe
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        // Le mot de passe est correct, on crée la session utilisateur
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        // Redirection en fonction du rôle de l'utilisateur
        if ($user['role'] === 'admin') {
            header('Location: administrateur.php');  // Redirige vers la page admin
        } elseif ($user['role'] === 'user') {
            header('Location: utilisateur.php');   // Redirige vers la page utilisateur
        } else {
            header('Location: /');  // Redirige vers la page d'accueil par défaut
        }
        exit;
    } else {
        // Si l'email ou le mot de passe est incorrect
        echo "email ou le mot de passe est incorrect. Veuillez réessayer.";
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
                            <form action="connexion.php" method="post">
                                <div>
                                    <input type="email" class="form-control" name="email" placeholder="email" required>
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