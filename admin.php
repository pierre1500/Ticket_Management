<?php
//connect to the database
$bdd = new PDO('mysql:host=localhost;dbname=dali', 'root', '');
//Verify if the form is sent and if the information is correct, if yes, user is redirected to the pageList.php else, a message of error is displayed
if (isset($_POST['emailTech']) && isset($_POST['mdpTech'])) {
    $req = $bdd->prepare('SELECT * FROM technicien WHERE emailTech = :emailTech AND mdpTech = :mdpTech');
    $req->execute(array(
        'emailTech' => $_POST['emailTech'],
        'mdpTech' => $_POST['mdpTech']
    ));
    $donnees = $req->fetch();
    if ($donnees) {
        echo '<p style="color="red" text-align: center">Vous êtes connecté</p>';
        header('Location: pageList.php');
    } else {
        echo '<p style="color="red" text-align: center">Mauvaise information de connection</p>';
    }
}
?>
<h1 style="text-align: center">Gestion des Tickets</h1>
<h2 style="text-align: center">Connection</h2>
<form style="text-align: center" method="POST">
    <div>
        <label>Email</label>
        <br>
        <input type="email" name="emailTech">
        <br>
        <label>Password</label>
        <br>
        <input style=" margin-bottom: 40px; " type="password" name="mdpTech">
    </div>
    <div>
        <input type="submit" value="Connexion">
    </div>
</form>
