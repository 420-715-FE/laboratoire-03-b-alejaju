<?php

session_start();

if(isset($_GET['deconnexion'])){
session_unset();
session_destroy();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page secrète</title>
    <link rel="stylesheet" href="../water.css">
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>
    <h1>Page secrète</h1>

    <?php

$Donnes=[
    'jaja72' => ['nom' => 'Jacynthe Laplante', 'motDePasse' => 'lapin'],
    'petitefleur145' => ['nom' => 'Rose Lafleur', 'motDePasse' => 'chat'],
    'bob' => ['nom' => "Bob L'éponge", 'motDePasse' => 'poisson'],
];

if(isset($_POST['nomutilisateur']) && isset($_POST['motdepasse'])){
 $nomutilisateur = $_POST['nomutilisateur'];
 $motdepasse = $_POST['motdepasse'];

 if (isset($Donnes[$nomutilisateur])&& $Donnes[$nomutilisateur]['motDePasse'] === $motdepasse){
    $vrainom = $Donnes[$nomutilisateur]['nom'];
        echo '<br> Bonjour ' . $vrainom . ', bienvenue sur la page secrète !';
        echo '<br>';

    } else {
        echo 'Erreur : nom d\'utilisateur ou mot de passe incorrect.';
        }

}
//Verification mot de passe initial 
    /*if(isset($_POST['motdepasse'])){
        $motdepasse = $_POST['motdepasse'];
        if($motdepasse==='abricot'){
            echo 'Bravo! Vous avez trouvé le mot de passe! »';
        }
        else {
            echo 'Mot de passe incorrect';  
        } }*/
    
?>
    <form action="page_secrete.php" method="POST"><br>
    <label for="nomdutilisateur">Nom d'utilisateur</label>
    <input type ="text" name="nomutilisateur">
    <label for="motdepasse">Mot de passe</label>
    <input type="text" name ="motdepasse">
    <button> Soumettre </button>

    </form>

    <p>
        <a href="?deconnexion">Deconnexion</a>
    </p>
</body>
</html>
