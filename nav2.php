<ul id="nav">
    <?php if (!isset($_SESSION['user'])) { ?>
        <li><a class="btn btn-purple" href="register.php" class="bouton">Créer un compte</a></li>
      <link rel="stylesheet" href="nav.css">
    <?php } else { ?>
        <li><a class="btn btn-purple" href="persos.php"><?php echo $_SESSION['user']['email'] ?></a></li>
        <li><a class="btn btn-purple" href="modif_compte.php">Mon compte</a></li>
        <li><a class="btn btn-purple" href="logout.php">Logout</a></li>
       
    <?php } ?>
</ul>