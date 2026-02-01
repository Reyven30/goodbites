<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - RoyalBites' : 'RoyalBites - Premium Burger Experience'; ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Righteous&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Global CSS -->
    <link href="/assets/mycss/global.css" rel="stylesheet">
    
    <!-- Page-specific CSS -->
    <?php if (isset($pageCSS)): ?>
    <link href="/assets/mycss/<?php echo $pageCSS; ?>" rel="stylesheet">
    <?php endif; ?>
</head>
<body>
