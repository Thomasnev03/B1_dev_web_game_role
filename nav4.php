
<ul id="nav">
    <?php if (!isset($_SESSION['user'])) { ?>
        <li><a href="persos.php" class="bouton">Retour au menu</a></li>
        <li><a href="logout.php" class="bouton">logout</a></li>
        
    <?php } else { ?>
        <li><a href="persos.php">Retour au jeu</a></li>
        <li><a href="modif_compte.php">Mon compte</a></li>
        <li><a href="logout.php">Logout</a></li>
       
    <?php } ?>
</ul>