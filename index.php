<?php
session_start();
include 'tic-tac-toe-functions.php';
include 'more-game-functions.php';

// Initialize the game if it's not already started
if (!isset($_SESSION['turn'])) {
    initializeGame();
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        resetGame();
    } elseif ($_SESSION['winner'] === null) {
        foreach ($_POST as $position => $value) {
            handleMove($position);
        }
    }
}

$isDraw = isDraw();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tic Tac Toe</title>
    <link rel="stylesheet" href="tic-tac-toe-style-guide.css">
</head>
<body>
    <h1>Tic Tac Toe</h1>

   <?php
        if ($_SESSION['winner'] === null) {
           if (!$isDraw) {
            print "<p>Turn: {$_SESSION['turn']}</p>";
        } else {
            print "<p>It's a draw!</p>";
         }
     } else {
            print "<p>The winner is {$_SESSION['winner']}!!</p>";
       }
    ?>

    <form method = "POST">
        <table>
            <?php 
            for ($row = 1; $row <= 3; $row++) {
                print "<tr>";

                for ($col = 1; $col <= 3; $col++) {
                    $pos = "$col-$row";
                    $value = $_SESSION['board'][$pos];
                    $cellClass = $value ? $value : 'empty';
                    print "<td class = '$cellClass'>";

                    if ($value === '' && $_SESSION['winner'] === null && !$isDraw) {
                        print "<button type = 'submit' name = '$pos'> </button>";
                    } elseif ($value !== '') {
                        print $value;
                    }
                    print "</td>";
                }
                print "</tr>";
            }
            ?>
        </table>

            <br>
        <button type="submit" name="reset">Reset Game</button>
    </form>
</body>
</html>
        
