<?php
session_start();
$connexion = mysqli_connect("localhost", "root", "", "moduleconnexion");


if(isset($_POST["button"]))
{       
        $login = htmlspecialchars($_POST["login"]);
        $mdp = htmlspecialchars($_POST['password']);

        if(!empty($login) && !empty($mdp))
        {       
                $query = "SELECT login FROM utilisateurs WHERE login='$login'";
                $execquery = mysqli_query($connexion, $query);
                $rows = mysqli_num_rows($execquery);


                if($rows==0)
                {       $erreur = "Login ou mot de passe incorrect.";
                        
                }
                else
                {
                        
                        $checkpass = "SELECT password FROM utilisateurs WHERE login = '$login'";
                        $checkpassquery = mysqli_query($connexion,$checkpass);
                        $cryptedpass = mysqli_fetch_all($checkpassquery);
                        $cryptedpass = $cryptedpass[0][0];
                        $passencrypt = password_verify($mdp, $cryptedpass);
                        
                        if($passencrypt == true)
                        {
                        $userinfo = mysqli_fetch_all($execquery);
                        $infos = "SELECT id,login,prenom,nom FROM utilisateurs WHERE login ='$login'";
                        $query = mysqli_query($connexion, $infos);
                        $result = mysqli_fetch_all($query);
                        $_SESSION['id'] = $result[0][0];
                        $_SESSION['login'] = $_POST['login'];
                        $_SESSION['prenom'] = $result[0][2];
                        $_SESSION['nom'] = $result[0][3];
                        $_SESSION['password'] = $_POST['password'];
                        header('Location: index.php');
                        }
                        else
                        {
                                
                                $erreur = "Login ou mot de passe incorrect.";
                        }
                       
                }
                
        
                if($_POST['login'] == 'admin' && $_POST['password'] == 'admin')
        {
               
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['id'] = $result[0][0];
                $_SESSION['prenom'] = $result[0][2];
                $_SESSION['nom'] = $result[0][3];
                header('Location: index.php');
        

        }
       
}
else
{
        $erreur = "Tous les champs doivent être complétés.";
}


}


?>



                
        <?php if(isset($erreur)) 
    {
        echo "<b>"."<p style='color:red; font-size:20px; padding-bottom:20%; text-align:center; padding-top : 13%'>".$erreur."</p>"."</b>";
    }
?>

<!DOCTYPE html>
<html>

    <head>
            <link href="" rel="shorcut icon">
            <meta charset="utf-8">
            <title>Connexion</title>
            <link rel="stylesheet" href="index.css">
    </head>
    <body id="Connexion">
    <nav id="index">
                <a href="index.php">Accueil</a>
                <a href="register.php">Inscription</a>
            </nav>
            <form class="box" action="connexion.php" method="post">
                    <h1>Connexion</h1>
                    <input type="text" name="login" placeholder="Login">
                    <input type="password" name="password" placeholder="Mot de passe">
                    <input type="submit" name="button" value="Connexion">
             </form>
    </body>
</html>