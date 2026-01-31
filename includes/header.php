    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>BurgerQueen</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/mycss/global.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Righteous&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <?php if (isset($paginaCSS)): ?>
    <link href="assets/mycss/<?php echo $paginaCSS; ?>" rel="stylesheet">
    <?php endif; ?>
