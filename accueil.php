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
            header('Location: persos.php');
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
        <link rel="stylesheet" href="css/accueil.css">
    </head>
    <body>
        <div class="imagebackgroundacc">
            <div class="text"><h1>Bienvenue sur le jeu ROLEDJ</h1>
            <h2>Voici les règle :</h2>
            <p>zzaaal,efnnfkalnfnklnfzjbfhabefbjab</p>
            </div>
            <form action="persos.php">
    <input type="submit" value="accéder au jeu">
    </form>
    </div>

    </body>
    </html>