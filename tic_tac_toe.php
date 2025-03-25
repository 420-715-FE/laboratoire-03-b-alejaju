<?php

session_start();

if (isset($_GET['reinitialiser'])) {
    unset($_SESSION['grille']);
    unset($_SESSION['tour']);
}

$grille = [
    ['', '', ''],
    ['', '', ''],
    ['', '', ''],
];

$tour = 'X';

if (isset($_SESSION['grille'])) {
    $grille = $_SESSION['grille'];
    $tour = $_SESSION['tour'];
}

if (
    isset($_GET['ligne']) && isset($_GET['colonne'])
    && (int)$_GET['ligne'] == $_GET['ligne']
    && (int)$_GET['colonne'] == $_GET['colonne']
    && $_GET['ligne'] >= 0 && $_GET['ligne'] < 3
    && $_GET['colonne'] >= 0 && $_GET['colonne'] < 3
) {
    $ligne = $_GET['ligne'];
    $colonne = $_GET['colonne'];

    if ($grille[$ligne][$colonne] === '') {
        $grille[$ligne][$colonne] = $tour;
        $tour = $tour === 'X' ? 'O' : 'X';
    }

    $_SESSION['grille'] = $grille;
    $_SESSION['tour'] = $tour;
}

// Détection d'une victoire verticale
for ($i = 0; $i < 3; $i++) {
    if ($grille[$i][0] !== '' && $grille[$i][0] === $grille[$i][1] && $grille[$i][1] === $grille[$i][2]) {
        $vainqueur = $grille[$i][0];
    }
}

// Détection d'une victoire horizontale
for ($j = 0; $j < 3; $j++) {
    if ($grille[0][$j] !== '' && $grille[0][$j] === $grille[1][$j] && $grille[1][$j] === $grille[2][$j]) {
        $vainqueur = $grille[0][$j];
    }
}

// Détection d'une victoire en diagonal
if (
    ($grille[0][0] != '' && $grille[0][0] === $grille[1][1] && $grille[1][1] === $grille[2][2])
    || ($grille[0][2] != '' && $grille[0][2] === $grille[1][1] && $grille[1][1] === $grille[2][0])
) {
    $vainqueur = $grille[0][0];
}

// Détection d'un match nul
if (!isset($vainqueur)) {
    $matchNul = true;
    foreach ($grille as $ligne) {
        foreach ($ligne as $case) {
            if ($case === '') {
                $matchNul = false;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
    <link rel="stylesheet" href="../water.css">
    <style>
        .ticTacToe {
            border-collapse: collapse;
            width: auto;
        }

        .ticTacToe tr {
            background-color:rgba(254, 254, 254, 0.57) !important;
        }

        .ticTacToe td {
            border: 1px solid black;
            width: 75px;
            height: 75px;
            text-align: center;
            vertical-align: middle;
            color: black;
            font-size: 2em;
        }

        .ticTacToe a {
            color: darkblue;
        }
    </style>
</head>
<body>
    <nav>
        <a href="../index.php">Retour</a>
    </nav>
    <h1>Tic Tac Toe</h1>
    <?php
        if (isset($vainqueur)) {
            echo "<p>Les <strong>{$vainqueur}</strong> ont gagné!</p>";
        } elseif ($matchNul) {
            echo "<p>Match nul!</p>";
        } else {
            echo "<p>C'est le tour des <strong>{$tour}</strong>.</p>";
        }
    ?>
    <table class="ticTacToe">
        <?php

        foreach ($grille as $i => $ligne) {
            echo '<tr>';
            foreach ($ligne as $j => $case) {
                if ($case == '' && !isset($vainqueur)) {
                    echo "<td><a href=\"?ligne=$i&colonne=$j\">( )</a></td>";
                } else {
                    echo '<td>' . $case . '</td>';
                }
            }
            echo '</tr>';
        }

        ?>
    </table>
    <a href="?reinitialiser">Réinitialiser</a>
</body>
</html>
