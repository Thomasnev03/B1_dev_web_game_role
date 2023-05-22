<?php
require_once('functions.php');
require_once('nav.php');
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

</head>
<link rel="stylesheet" href="css/nav.css">
<link rel="stylesheet" href="css/contact.css">
<body>

<h1> Exprimez vous, nous vous écoutons:</h1><br><br><hr><br>

<form action="" method="$_POST">



                   <label>

                     Veuillez renseignez votre nom : <span class="required">*</span>

                  </label>

                  <input type="text" name="nom" class="long"/>

                  <span class="error" id="errorname"></span><br><br>

                  Veuillez renseignez votre Prénom : <span class="required">*</span>

                  </label>

                  <input type="text" name="prenom" class="long"/>

                  <span class="error" id="errorname"></span><br><br>

                

                  <label>

                     Veuillez renseignez votre adresse e-mail :<span class="required">*</span>

                  </label>

                  <input type="email" name="email" class="long"/>

                  <span class="error" id="erroremail"></span><br><br>

                  <label>

                     Message de contacte : <span class="required">*</span>

                  </label><br>

                  <textarea name="message" class="long field-textarea"></textarea>

                  <span class="error" id="errormsg"></span>

<br><br>

                  <input type="submit" value="Envoyer">      

                  <a href="contactadmin.php"><input type="submit" value="Réinitialiser"> </a>

      </form>







</form>

</body>

</html>