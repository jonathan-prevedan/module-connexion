<html>
<head>
    <link rel="stylesheet" href="index.css">
    <title>Accueil</title>
    <meta charset="utf-8">
</head>

<body id="index">
<header>
<nav id="index">
                <a href="index.php">Accueil</a>
                
        

                
</nav>
</header>
    <main id="main_index">     
<?php
session_start();

if(isset($_POST['buttond']))
{
	unset($_SESSION['login']);
	unset($_SESSION['password']);
    unset($_SESSION['profil']);
    header('Location: index.php');
}
 
if((isset($_SESSION['login']))&&(isset($_SESSION['password'])))
{
?>
<form class="button_edit" method="post" action="profil.php">
<input type="submit" name="profil" value="Modifications Profil">
</form>
<?php


       
?>			
		
<?php
if((isset($_SESSION['login']))&&(isset($_SESSION['password'])))
{
?>
<form id="deco" method="post" action="index.php">
<input type="submit" name="buttond" value="Déconnexion">
</form>

<?php
}
}

?>
	

<?php	

if(isset($_SESSION['login']) && $_SESSION['login']=="admin")	
{
?>
<form id="b_admin" method="post" action="admin.php">
<input type="submit" name="profil" value="Admin">
</form>
<?php

}

?>



<?php

if(isset($_SESSION['login']))
{
?>

<p id="messageindex"><?php echo "Bonjour"," " .$_SESSION['login']," ", "!"?></p>

<?php
}

?>
<?php 
if(empty($_SESSION['login']))
{
?>
<form class="button_edit" method="post" action="connexion.php">
<input type="submit" name="profil" value="Connexion">
<br/>
</form>

    <form class="button_edit" method="post" action="register.php">
        <input type="submit" name="inscription" value="Inscription">
    </form>
<?php
} 
?>

<h1 id="h1_index">Voyez la vie d'un autre œil !</h1>

    </main>
</body>