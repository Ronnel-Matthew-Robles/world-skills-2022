<?php 
// Initialize session and game data 
session_start(); 
if (!isset($_SESSION['game'])) { 
    // If game data not set, initialize it 
    $_SESSION['game'] = [ 
        'board' => ['', '', '', '', '', '', '', '', ''], 
        'turn' => 'X', 
        'winner' => null, 
        'moves' => 0 
        ]; 
        } 
    // Handle requests 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        // Handle move request 
        $index = $_POST['index']; 
        $player = $_SESSION['game']['turn']; 
        $board = $_SESSION['game']['board']; 
        // Check if move is valid 
        if ($board[$index] !== '' || $_SESSION['game']['winner'] !== null) { 
            http_response_code(400); 
            die(); 
        } 
        // Make move 
        $board[$index] = $player; 
        $_SESSION['game']['board'] = $board; 
        $_SESSION['game']['moves']++; 
        
        // Check for winner 
        $winningLines = [ 
            // Horizontal lines 
            [0, 1, 2], [3, 4, 5], [6, 7, 8], 
            // Vertical lines 
            [0, 3, 6], [1, 4, 7], [2, 5, 8], 
            // Diagonal lines 
            [0, 4, 8], [2, 4, 6] 
        ]; 
        
        foreach ($winningLines as $line) { 
            if ($board[$line[0]] !== '' && $board[$line[0]] === $board[$line[1]] && $board[$line[1]] === $board[$line[2]]) { 
                // We have a winner 
                $_SESSION['game']['winner'] = $player; break; 
            } 
        } 
        
        // Switch turns 
        $_SESSION['game']['turn'] = $player === 'X' ? 'O' : 'X'; 
        // Return updated game state 
        header('Content-Type: application/json'); 
        echo json_encode($_SESSION['game']); 
        exit; 
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') { 
        // Handle get request to retrieve game state 
        header('Content-Type: application/json'); 
        echo json_encode($_SESSION['game']); 
        exit; 
    } 
?>