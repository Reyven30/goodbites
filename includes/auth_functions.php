<?php
/**
 * Funzioni Autenticazione - Gestione login utenti
 */
require_once 'data/db.php';

// Verifica se l'utente è loggato
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Login utente con email e password
function login($email, $pwd) {
    $user = getUserByEmail($email);
    
    // Controllo password semplice
    if ($user && $user['password'] === $pwd) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        return true;
    }
    return false;
}

// Logout utente
function logout() {
    session_unset();
    session_destroy();
}
?>
