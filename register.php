<?php 
session_start();
$connexion = mysqli_connect('localhost','root','','moduleconnexion');


if(isset($_POST['button']))
{
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $cmdp = password_hash($_POST['cpassword'], PASSWORD_DEFAULT);
        $login = htmlspecialchars($_POST['login']);

        $loginlenght = strlen($_POST['login']);
        $nomlenght = strlen($_POST['nom']);
        $prenomlenght = strlen ($_POST['prenom']);
        

    if(!empty($_POST['login']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password']) && !empty($_POST['cpassword']))
    {   
        $login = $_POST['login'];
        $check = "SELECT login FROM utilisateurs WHERE login = '$login'";
        $query_exist= mysqli_query($connexion,$check);
        $result_exist= mysqli_num_rows($query_exist);
        
        
        if (mysqli_num_rows($query_exist) == 0)
    {  
        
        if($loginlenght <= 255)
        {
        
            if($_POST['password'] == $_POST['cpassword'])
            {
                $insertmbr =("INSERT INTO utilisateurs(login,prenom,nom,password) VALUES ('$login','$prenom','$nom','$mdp')");
                $query= mysqli_query($connexion, $insertmbr);
                $eror = "Votre compte à bien été crée ! ";
                header('Location: index.php');
            }
            else
            {
                $eror = "Vos mots de passes ne correspondent pas !";
            }
            

        }
        else
        {
            $eror = "Votre pseudo n'est pas valide !";
        }
        if($nomlenght <= 255)
        {   
        }
        else
        {
            $eror = "Vous ne pouvez pas utiliser ce".$_POST['nom']." !";
        }
        if($prenomlenght <= 255)
        {
        }
        else
        {
            $eror = "Vous ne pouvez pas utiliser ce".$_POST['prenom']." !";
        }
    }
     else
     {
        $erreur = "Ce login n'est pas disponnible";
        echo "<b>".$erreur."</b>";
     }
    
    }
    else
        {
            $eror = "Tous les champs doivent être complétés.";
        }
}
if(isset($eror))
        {
            echo $eror;
        } 
        
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Inscription</title>
</head>
<body id="register">
<nav id="index">
                <a href="index.php">Accueil</a>
                
</nav>
        
    <main id="main_register">
        <h1>Inscription</h1>
        <form method="POST" action="register.php">
            <input type="text" name="login" placeholder="Nom d'utilisateur" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="cpassword" placeholder="Confirmer" required>
            <input type="submit" name="button" value="S'inscrire">
            <?php
    if(isset($eror))
        {
            echo $eror;
        } 
        
    ?>
        </form>
        <a href="connexion.php">Se connecter</a>
    </main>
    


    </body>
</html>