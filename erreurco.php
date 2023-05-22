<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_erreur_co.css">
  <!--  <script>
        setTimeout(function(){
            window.location.href = "login.php";
        },4000);
    </script>-->
</head>
<body>
<h1>Erreur</h1><br><br>


<h3><br>cette identifiant ou mot de passe n'existe pas !!!<br><br></h3>
<?php header("refresh:3, url=login.php")?>
</body>
</html>