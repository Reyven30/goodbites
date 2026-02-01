<?php
/**
 * Auth Functions - User authentication
 */

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Login user with email and password
function login($email, $pwd) {
    require_once 'data/users.php';
    $user = getUserByEmail($email);
    
    // Simple password check
    if ($user && $user['password'] === $pwd) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        return true;
    }
    return false;
}

// Logout user
function logout() {
    session_unset();
    session_destroy();
}
?>
