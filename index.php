<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
     <link rel="stylesheet" href="css/nav.css">
     <link rel="stylesheet" href="css/logout.css">
</head>
<div>
<body>
    <?php require('nav2.php'); ?>
    <?php
        echo "Vous avez quittez votre session !";
    ?>
    <?php header("refresh:3, url=login.php")?>
</body>
</div>
</html>

