<?php

    require_once('./classes/Gobelin.php');
    require_once('./classes/Darknight.php');
    require_once('./classes/Sorcier.php');

    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_SESSION['perso'])) {
        header('Location: persos.php');
    }

    // On créé un combat s'il n'y en a pas encore
    if (!isset($_SESSION['fight']))
    {
        $nb = random_int(0,10);

        if ($nb <= 5) {
            $ennemi = new Gobelin();
        } else if ($nb = 6||7) {
            $ennemi = new DarkKnight();
        } else  {
            $ennemi = new Sorcier();
        }

        $_SESSION['fight']['ennemi'] = $ennemi;
        $_SESSION['fight']['html'][] = "Vous tomber sur un " . $ennemi->name . '.';
    }

    // dd($_SESSION['fight']);
    // On gere le tour de combat.
    // L'ennemi tape en premier
    if ($_SESSION['fight']['ennemi']->speed > $_SESSION['perso']['vit']) {
        $_SESSION['fight']['html'][] = $ennemi->name . ' tape en premier';
        
        $touche = random_int(0, 20);
        $_SESSION['fight']['html'][] = $touche;

        if ($touche >= 10) {
            $_SESSION['fight']['html'][] = "Il vous touche.";
            $degat = random_int(0, $_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power/3);
            $_SESSION['fight']['html'][] = "Il vous inflige " . ($degat - floor($_SESSION['perso']['for']/3)) . " dégats";
            $_SESSION['perso']['pdv'] -=  $degat - floor($_SESSION['perso']['for']/3);
        } else {
            $_SESSION['fight']['html'][] = "Il vous rate.";
        }

        if ($_SESSION['perso']['pdv'] <= 0) {
            $_SESSION['fight']['html'][] = "Vous etes mort.";
        } else {
            $_SESSION['fight']['html'][] = "Vous attaquez";

            $touche = random_int(0, 20);
            $_SESSION['fight']['html'][] = $touche;

            if ($touche >= 10) {
                $_SESSION['fight']['html'][] = "Vous touchez votre ennmi.";
                $degat = random_int(0,10) + floor($_SESSION['perso']['for']/3);
                
                $_SESSION['fight']['html'][] = "Vous lui infligez " . ($degat - floor($_SESSION['fight']['ennemi']->constitution/3)) . " dégats";
                $_SESSION['fight']['ennemi']->pol -=  $degat - floor($_SESSION['fight']['ennemi']->constitution/3);

                if ($_SESSION['fight']['ennemi']->pol <= 0) {
                    $_SESSION['perso']['gold'] += $_SESSION['fight']['ennemi']->gold;
                    $_SESSION['fight']['html'][] = "Vous gagnez " . $_SESSION['fight']['ennemi']->gold . " Or";
                    $_SESSION['fight']['html'][] = "Vous avez tuez votre ennemi.";
                }
            } else {
                $_SESSION['fight']['html'][] = "Vous ratez votre ennmi.";
            }
        }

    } else {
        $_SESSION['fight']['html'][] = $_SESSION['perso']['name'] . ' tape en premier';
    
        $touche = random_int(0, 20);
        $_SESSION['fight']['html'][] = $touche;

        if ($touche >= 10) {
            $_SESSION['fight']['html'][] = "Vous touchez votre ennmi.";
            $degat = random_int(0,10) + floor($_SESSION['perso']['for']/3);
            $_SESSION['fight']['html'][] = "Il vous inflige " . ($degat - floor($_SESSION['fight']['ennemi']->constitution/3)) . " dégats";
            $_SESSION['fight']['ennemi']->pol -=  $degat - floor($_SESSION['fight']['ennemi']->constitution/3);

            if ($_SESSION['fight']['ennemi']->pol <= 0) {
                $_SESSION['perso']['gold'] += $_SESSION['fight']['ennemi']->gold;
                $_SESSION['fight']['html'][] = "Vous gagnez " . $_SESSION['fight']['ennemi']->gold . " Or";
                $_SESSION['fight']['html'][] = "Vous avez tuez votre ennemi.";
            } else {
                $_SESSION['fight']['html'][] = "Votre ennemi attaque";
                $touche = random_int(0, 20);
                $_SESSION['fight']['html'][] = $touche;

                if ($touche >= 10) {
                    $_SESSION['fight']['html'][] = "Il vous touche.";
                    $degat = random_int(0,$_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power/3);
                    $_SESSION['fight']['html'][] = "Il vous inflige " . ($degat - floor($_SESSION['perso']['for']/3)) . " dégats";
                    $_SESSION['perso']['pdv'] -=  $degat - floor($_SESSION['perso']['for']/3);
                } else {
                    $_SESSION['fight']['html'][] = "votre ennemi vous rate.";
                }
            }
        } else {
            $_SESSION['fight']['html'][] = "Vous ratez votre ennemi.";

            // Attaque de l'ennemi
            $_SESSION['fight']['html'][] = "Votre ennemi attaque";
            $touche = random_int(0, 20);
            $_SESSION['fight']['html'][] = $touche;

            if ($touche >= 10) {
                $_SESSION['fight']['html'][] = "Il vous touche.";
                $degat = random_int(0,$_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power/3);
                $_SESSION['fight']['html'][] = "Il vous inflige " . ($degat - floor($_SESSION['perso']['for']/3)) . " dégats";
                $_SESSION['perso']['pdv'] -=  $degat - floor($_SESSION['perso']['for']/3);
            
                if ($_SESSION['perso']['pdv'] <= 0) {
                    $_SESSION['fight']['html'][] = "Vous etes mort.";
                }
            } else {
                $_SESSION['fight']['html'][] = "Votre ennemi vous rate.";
            }
        }
    }

    // Sauvegarde de l'état de votre personnage
    $bdd = connect();
    $sql = "UPDATE persos SET `xp` = :xp, `gold` = :gold, `pdv` = :pdv WHERE id = :id AND user_id = :user_id;";    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'xp'       => $_SESSION['perso']['xp'],
        'gold'      => $_SESSION['perso']['gold'],
        'pdv'       => $_SESSION['perso']['pdv'],
        'id'        => $_SESSION['perso']['id'],
        'user_id'   => $_SESSION['user']['id']
    ]);

    // dd($_SESSION);

    if ($_SESSION['perso']['pdv'] <= 0) {
        unset($_SESSION['perso']);
        unset($_SESSION['fight']);
        header('Location: dead_perso.php');
    }

    require_once('header.php');
?>
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/nav.css">
    <div class="container">
        <div class="row mt-4">
            <div class="px-4">
                <?php require_once('_perso.php'); ?>
            </div>
            <div class="">
                <h1>Combat</h1>
                <?php

                    foreach($_SESSION['fight']['html'] as $html) {
                        echo '<p>'.$html.'</p>';
                    }

                ?>

                <?php if ($_SESSION['fight']['ennemi']->pol > 0) { ?>
                    <a class="btn btn-green" href="donjon_fight.php?id=<?php echo $_GET['id']; ?>">
                        Attaquer
                    </a>
                    <a class="btn btn-blue" href="donjon_play.php?id=<?php echo $_GET['id']; ?>">
                        Fuir
                    </a>
                <?php } else { ?>
                    <a class="btn btn-green" href="donjon_play.php?id=<?php echo $_GET['id']; ?>">
                        Continuer l'exploration
                    </a>
                <?php } ?>
            </div>
            <div class="px-4">
                <?php require_once('_ennemi.php'); ?>
            </div>
        </div>
    </div>
    </body>
</html>