<?php

    require_once('functions.php');

    if (isset($_POST["send"])) {
        $bdd = connect();
        $sql = "SELECT * FROM users WHERE `email` = :email;";
        
        $sth = $bdd->prepare($sql);
        
        $sth->execute([
            'email'     => $_POST['email']
        ]);

        $user = $sth->fetch();
        
        if ($user && password_verify($_POST['password'], $user['password']) ) {
            // dd($user);
            $_SESSION['user'] = $user;
            header('Location: accueil.php');
        } else {
            header('Location: erreurco.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/log.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<?php require_once('nav2.php'); ?>
<body>

    <div class="container_form">
    <form action="" method="post">
        <h1>Connexion</h1>

        <?php if (isset($msg)) { echo "<div>" . $msg . "</div>"; } ?>

        <div>
            <label for="email">Email</label>
            <input 
                type="email" 
                placeholder="Entrez votre email" 
                name="email" 
                id="email" 
            />
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input 
                type="password" 
                placeholder="Entrez votre mot de passe" 
                name="password" 
                id="password" 
            />
        </div>
        <div>
            <input type="submit" name="send" value="Connexion" />
        </div>

        <div>
        <a href="contactadmin.php"> <input type="button" value="contact" value="Nous contacter"/>
           </a>
        </div>

    </form>
    </div>
</body>
</div>
</html>
