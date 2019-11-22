<?php
if(isset($_SESSION['username']))
{
    header('Location index.php');
}


$co = mysqli_connect('Localhost','root','','moduleconnexion');

$cmd = "SELECT * FROM utilisateurs";

$query = mysqli_query($co,$cmd);

?>

<html>
    <head>
    <link rel="stylesheet" href="index.css">
        <meta charset="utf-8">
        <title>Panel Admin</title>
    </head>

    <body id="admin">
    <nav id="index">
                <a href="index.php">Accueil</a>                
</nav>
            <h1 id="admin_h1">Utilisateurs inscrits :</h1><br/>
            <h1 id="admin_h1_"> Vous avez un œil sur tout ! </h1>
    <main id="main_admin">
    <table>
        <th>Id</th>
        <th>Login</th>
        <th>Prenom</th>
        <th>Nom</th>

        <?php 
        while ($resultat = mysqli_fetch_array($query))
        {
        ?>

        <tr>
            <td><?php echo $resultat['id'] ?></td>
            <td><?php echo $resultat['login'] ?></td>
            <td><?php echo $resultat['prenom'] ?></td>
            <td><?php echo $resultat['nom'] ?></td>
        </tr>
        <?php } ?>
    </table>
    </main>
    </body>

</html>