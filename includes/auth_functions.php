<?php
/**
 * Funzioni Autenticazione - Gestione login utenti
 */

// Controlla se l'utente è loggato
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Effettua il login con email e password
function login($email, $pwd) {
    require_once 'data/users.php';
    $user = getUserByEmail($email);
    
    // Controllo password
    if ($user && $user['password'] === $pwd) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        return true;
    }
    return false;
}

// Effettua il logout
function logout() {
    session_unset();
    session_destroy();
}
?>
