<?php
    require_once('functions.php');

        // Vérifie que l'utilisateur est connecté, s'il n'est pas connecté, il l'envoie vers "login.php"
        if (!isset($_SESSION['user'])) 
        {
            header('Location: login.php');
        }

        // Vérifie que l'utilisateur à choisi un personnage 
        if (!isset($_SESSION['perso'])) 
        {
            header('Location: persos.php');
        }
    
        // Envoie la valeur de la fonction connect() dans la variale $bdd
        $bdd = connect();
    
        $sql = "SELECT * FROM donjons";
        
        $sth = $bdd->prepare($sql);
    
        $sth->execute();
    
        $donjons = $sth->fetchAll();
?>

<?php require_once('header.php'); ?>
<link rel="stylesheet" href="css/nav.css">
<link rel="stylesheet" href="css/donjonentree.css">
<body>
    <div class="container">
        <?php echo $_SESSION['perso']['name']; ?> (<a href="persos.php">Changer</a>)
        <ul>
            <?php foreach($donjons as $donjon) { ?>
            <li><a class="btn btn-green"
href="donjon_play.php?id=<?php echo $donjon['id']; ?>">
                <?php echo $donjon['name']; ?>
            </a></li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
