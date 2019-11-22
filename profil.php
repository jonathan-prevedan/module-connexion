<?php
session_start();
$connexion = mysqli_connect("localhost", "root", "", "moduleconnexion");



    $login=$_SESSION['login'];
    


if(isset($_POST['button']))
{   
    if(isset($_POST['login']))
    {
        if($_POST['login'] != $_SESSION['login'])
        {
            $userconnect = $_SESSION['id'];
            $login = htmlspecialchars($_POST['login']);
            $query = "UPDATE utilisateurs SET login='$login' WHERE id='$userconnect'";
            $execquery = mysqli_query($connexion, $query);
            $_SESSION['login'] = $login;
        }

    }
        
    if(isset($_POST['prenom']))
    {
        
        if($_POST['prenom'] != $_SESSION['prenom'])
        {   
            $userconnect = $_SESSION['id'];
            $prenom = htmlspecialchars($_POST['prenom']);
            $query = "UPDATE utilisateurs SET prenom ='$prenom' WHERE id='$userconnect'";
            $execquery = mysqli_query($connexion, $query);
            $_SESSION['prenom'] = $prenom;
        }
    }

    if(isset($_POST['nom']))
    {
        if($_POST['nom'] != $_SESSION['nom'])
        {
            $userconnect = $_SESSION['id'];
            $nom = htmlspecialchars($_POST['nom']);
            $query = "UPDATE utilisateurs SET nom='$nom' WHERE id='$userconnect'";
            $execquery = mysqli_query($connexion, $query);
            $_SESSION['nom'] = $nom;
        }
    }

    if(isset($_POST['password']))
    {   
            $password = htmlspecialchars($_POST["password"]);
            $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
            $userconnect = $_SESSION['id'];
            $query = "UPDATE utilisateurs SET password='".$password."' WHERE id='$userconnect'";
            $execquery = mysqli_query($connexion, $query);
            $_SESSION['password'] = $password;

    }

      
}
if(isset($_POST['buttond']))
{
    unset($_SESSION['id']);
    unset($_SESSION['login']);
    unset($_SESSION['prenom']);
    unset($_SESSION['nom']);
    unset($_SESSION['password']);
    header('Location: index.php');
}

$admin_query= ("SELECT * FROM utilisateurs WHERE login = '$login'");
$exec_admin_query=mysqli_query($connexion,$admin_query);
$row= mysqli_fetch_array($exec_admin_query);
?>
<html>

<head>
        <link rel="stylesheet" href="index.css">
        <meta charset="utf-8">
        <title>Profil</title>
</head>

<body id ="register">

<nav id="index">
                <a href="index.php">Accueil</a>
</nav>

<main id="main_register">

<form method="POST" action="" class="login-box">

<h1>Modifications Profil</h1>


        <input type="text" placeholder="Login" name="login" value="<?php echo $row['login']?>" required>
       
        <input type="text" placeholder="Prenom" name="prenom" value="<?php echo $row['prenom'] ?>" required> 
    
        <input type="text" placeholder="Nom" name="nom" value="<?php echo $row['nom'] ?>" required>

        
        <input type="password" placeholder="Mot de passe" name="password" value="" required>
       
        <input type="password" placeholder="Confirmation Mdp" name="cpassword" value="" required>

        <input id="bouton" type="submit" value="Appliquer" name="button">
        <input id="buttond" type="submit" value="Déconnecter" name="buttond">

<?php if(isset($erreur)) 
    {
        echo "<b>"."<p style='color:red; font-size:20px; padding-bottom:20%; text-align:center;'>".$erreur."</p>"."</b>";
    }
?>




</form>

</main>    

</body>

</html>
