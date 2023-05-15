
   <?php require_once('functions.php');?>

<!--if (!isset($_SESSION['user'])) {
}
    $id = $_GET["id"];
    $req = "update user set email
                            password 
        where id=$id";
    $res = mysqli_query($id, $req);
    
    header("refresh:0, url=header.php"); -->
    
    <?php require_once('nav3.php'); ?>
    
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/nav.css">

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
            <input type="submit" name="send" value="Changer de mot de passe" />
        </div>
