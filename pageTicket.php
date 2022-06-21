<?php
//connect to the database
$bdd = new PDO('mysql:host=localhost;dbname=dali', 'root', '');
//Set idTicket to $id
$id = $_POST['idTicket'];
//If the interventionRealise is set, the ticket is update
if (isset($_POST['interventionRealisee'])) {
    $id = $_POST['idTicket'];
    $update = $bdd->prepare('UPDATE ticket SET interventionRealisee = :interventionRealisee WHERE idTicket = :idTicket');
    $update->execute(array(
        'idTicket' => $id,
        'interventionRealisee' => $_POST['interventionRealisee']
    ));
    // And the dateMAJ was updated
    $update = $bdd->prepare('UPDATE ticket SET dateMAJ = :dateMAJ WHERE idTicket = :idTicket');
    $update->execute(array(
        'idTicket' => $id,
        'dateMAJ' => getdate()['year'] . '-' . getdate()['mon'] . '-' . getdate()['mday'] . ' ' . getdate()['hours'] . ':' . getdate()['minutes'] . ':' . getdate()['seconds']
    ));
    //Redirect to the pageList.php
    header('Location: pageList.php');
}
    //If the checkbox is checked, the ticket is update with the date of closing
    if (isset($_POST['close'])) {
        $update = $bdd->prepare('UPDATE ticket SET dateCloture = :dateCloture WHERE idTicket = :idTicket');
        $update->execute(array(
            'idTicket' => $id,
            'dateCloture' => getdate()['year'] . '-' . getdate()['mon'] . '-' . getdate()['mday'] . ' ' . getdate()['hours'] . ':' . getdate()['minutes'] . ':' . getdate()['seconds']
        ));
        //If the checkbox is checked, the ticket is update with the value 1
        if (isset($_POST['close'])) {
            $update = $bdd->prepare('UPDATE ticket SET actif = :actif WHERE idTicket = :idTicket');
            $update->execute(array(
                'idTicket' => $id,
                'actif' => 0
            ));
            //Redirect to the pageList.php
            header('Location: pageList.php');
        }
        //redirect to the pageList.php
        header('Location: pageList.php');
    }
    //If the idTicket is set, all the information of the ticket is displayed as $ligne
if (isset($_POST['idTicket'])) {
    $req = $bdd->prepare('SELECT * FROM ticket WHERE idTicket = :idTicket');
    $req->execute(array(
        'idTicket' => $id
    ));
    $ligne = $req->fetch();
}
?>

<h1 style="text-align: center">Gestion des tickets</h1>
<h2 style="text-align: center">Tickets #<?php echo $id?></h2>
<form style="text-align: center" action="pageTicket.php" method="post">
<label style="text-align: center">Date de création</label>
    <br>
<input disabled style="text-align: center" type="text" name="dateCreationTicket" value="<?php echo $ligne['dateCreationTicket']; ?>">
<br>
<label style="text-align: center">Nom</label>
    <br>
<input disabled style="text-align: center" type="text" name="nom" value="<?php echo $ligne['nom']; ?>">
<br>
<label style="text-align: center">Email</label>
    <br>
<input disabled style="text-align: center" type="email" name="email" value="<?php echo $ligne['email']; ?>">
<br>
<label style="text-align: center">Type d'intervention</label>
    <br>
<select disabled style="text-align: center">
    <?php
    //Value of database in the select
    $req = $bdd->query('SELECT * FROM typeintervention') or die(print_r($bdd->errorInfo()));
    while ($donnees = $req->fetch()) {
        echo '<option value='.$donnees['idType'].'>' .$donnees['descType'].'</option>';
    }
    ?>
</select>
<br>
<label style="text-align: center">Description</label>
    <br>
<textarea disabled style="text-align: center" name="description" value="<?php echo $ligne['description']; ?>" cols="30" rows="10"><?php echo $ligne['description']; ?></textarea>
<br>
<label style="text-align: center">Intervention réalisée</label>
    <br>
<textarea style="text-align: center" name="interventionRealisee" cols="30" rows="10"><?php echo $ligne['interventionRealisee']; ?></textarea>
<br>
    <input type="hidden" name="idTicket" value="<?php echo $ligne['idTicket']; ?>">
    <input type="hidden" name="dateMAJ" value="<?php  ?>">
<input style="text-align: center" name="close" value="close" type="checkbox"> <label>Fermeture du ticket</label>
<br>
<input style="text-align: center" type="submit" value="Envoyer">
</form>