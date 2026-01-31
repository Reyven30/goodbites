<?php
// Configuration file
session_start();

// Email configuration (configura con i tuoi dati SMTP)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-password');
define('FROM_EMAIL', 'noreply@burgerqueen.com');
define('FROM_NAME', 'BurgerQueen');

// Site configuration
define('SITE_NAME', 'BurgerQueen');
define('SITE_URL', 'http://localhost/burgerqueen');

// Include functions
require_once 'includes/auth_functions.php';
require_once 'includes/cart_functions.php';
?>
