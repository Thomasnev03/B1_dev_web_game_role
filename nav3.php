<ul id="nav">
    <?php if (!isset($_SESSION['user'])) { ?>
        <li><a class="btn btn-purple" href="login.php" class="bouton">Se connecter</a></li>
      <link rel="stylesheet" href="css/nav.css">
    <?php } else { ?>
        <li><a href="persos.php"><?php echo $_SESSION['user']['email'] ?></a></li>
        <li><a href="modif_compte.php">Mon compte</a></li>
        <li><a href="logout.php">Logout</a></li>
       
    <?php } ?>
</ul>