<?php

// Initialize the game
function initializeGame() {
    $_SESSION['turn'] = 'X';
    $_SESSION['board'] =  [
            '1-1' => '', '2-1' => '', '3-1' => '',
            '1-2' => '', '2-2' => '', '3-2' => '',
            '1-3' => '', '2-3' => '', '3-3' => ''];

    $_SESSION['winner'] = null;
}

// Handle a move
function handleMove($position) {
    if ($_SESSION['board'][$position] === '') {
        $_SESSION['board'][$position] = $_SESSION['turn'];
        $_SESSION[$position] = $_SESSION['turn']; // For the provided whoIsWinner function

        $_SESSION['winner'] = whoIsWinner();

        if ($_SESSION['winner'] === null) {
            $_SESSION['turn'] = ($_SESSION['turn'] === 'X') ? 'O' : 'X';
        }
    }
}

// Check if the game is a draw
function isDraw() {
    return !in_array('', $_SESSION['board']) && $_SESSION['winner'] === null;
}

// Reset the game
function resetGame() {
    session_destroy();
    header("Location: index3.php");
    exit();
}

?>