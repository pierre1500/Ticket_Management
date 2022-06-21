<?php
//connect to the database
$bdd = new PDO('mysql:host=localhost;dbname=dali', 'root', '');
//Send the request for inserting the ticket
if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['description'])) {
    $req = $bdd->prepare('INSERT INTO ticket (nom, email, description, idType) VALUES (:nom, :email, :description, :idType)');
    $req->execute(array(
        'nom' => $_POST['nom'],
        'email' => $_POST['email'],
        'description' => $_POST['description'],
        'idType' => $_POST['idType']
    ));
    echo '<p style="text-align: center;">Votre ticket a bien été envoyé</p>';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="dali.css">
    <title>index</title>
</head>
<body class="container">

<header>
    <h1>Bienvenue</h1>
</header>


<main class="main">
    <a href="admin.php">page connexion</a>
    <form  method="POST">
        <div>
            <label>nom</label>
            <input type="text" name="nom">
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>type d'intervention</label>
            <select name="idType">
                <?php
                //Value of database in the select
                $req = $bdd->query('SELECT * FROM typeintervention') or die(print_r($bdd->errorInfo()));
                while ($donnees = $req->fetch()) {
                    echo '<option value='.$donnees['idType'].'>' .$donnees['descType'].'</option>';
                }
                ?>
            </select>
        </div>
        <label >Description </label>
        <div>
            <textarea name="description"></textarea>
        </div>
        <div>
            <input type="submit" value="Envoyer">
    </form>
</main>
