<!-- Header - Meta tag e CSS -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? $pageTitle . ' - ' : '' ?>GoodBites</title>
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/mycss/global.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<?php if (isset($pageCss)): ?>
<link href="assets/mycss/<?= $pageCss ?>" rel="stylesheet">
<?php endif; ?>
