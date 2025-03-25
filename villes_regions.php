<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Villes et régions</title>
    <link rel="stylesheet" href="../water.css">
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>
    <h1>Villes et régions</h1>
    <?php 

$VillesRegions = [
    "Montréal"=> "Montréal",
    "Québec"=> "Québec",
    "Laval"=>"Laval",
    "Gatineau" =>"Outaouais",
    "Longueuil"	=>"Montérégie",
    "Sherbrooke"=>"Estrie",
    "Magog"=>"Estrie",
    "Coaticook"=>"Estrie",
    "Trois-Rivières"=>"	Mauricie",
    "Drummondville"=>"Centre-du-Québec",
];

if (isset($_POST['Ville'])){
    $Ville = $_POST['Ville'];
    if (isset($VillesRegions[$Ville])){
        echo 'La ville de ' . $Ville .' est dans la region administrative de  "'. $VillesRegions[$Ville] . '".';
    } else {
        echo 'Ville '. $Ville . ' est inconnue';
    }
    echo "<p><strong> Entrer une Ville </strong></p>";
    } 

    ?>

    <form action="villes_regions.php" method = "POST">
    <input type = "text" name = "Ville">
    <button type = "submit">Soumettre</button>

    </form>
</body>
</html>
