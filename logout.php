<?php
/**
 * Logout - Termina sessione utente
 */
session_start();
require_once 'includes/auth_functions.php';
logout();
header('Location: index.php');
exit;
?>
