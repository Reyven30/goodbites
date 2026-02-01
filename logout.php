<?php
/**
 * Logout - End user session
 */
session_start();
require_once 'includes/auth_functions.php';
logout();
header('Location: index.php');
exit;
?>
