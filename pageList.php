<?php
//connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=dali', 'root', '');
//Select all the tickets where the actif column == 1
$sql = 'SELECT * FROM ticket JOIN typeintervention ON ticket.idType  = typeintervention.idType WHERE actif = 1';
$req = $pdo->query($sql);

?>
<h1 style="text-align: center">Gestion des tickets</h1>
<h2 style="text-align: center">Tickets Ouverts</h2>
<table style="border: solid black 1px ;">
    <br>
    <tr style="border: solid black 1px ;">
        <th style="border: solid black 1px ;"><p>Nom</p></th>
        <th style="border: solid black 1px ;"><p>Mail</p></th>
        <th style="border: solid black 1px ;"><p>Type</p></th>
        <th style="border: solid black 1px ;"><p>Description</p></th>
        <th style="border: solid black 1px ;"><p>Gestion</p></th>

    </tr>
    <tr>
        <?php
        while ($ligne = $req->fetch()){
        ?>
        <!-- action="ticket.php" -->
        <form action="pageTicket.php" method="post">
            <!-- insert information in a table -->
            <td style="border: solid black 1px ;"><?php echo $ligne['nom']; ?></td>
            <td style="border: solid black 1px ;"><?php echo $ligne['email']; ?></td>
            <td style="border: solid black 1px ;"><?php echo $ligne['descType']; ?></td>
            <td style="border: solid black 1px ;"><?php echo $ligne['description']; ?></td>
            <td style="border: solid black 1px ;"><?php echo $ligne['idTicket']; ?></td>
            <td style="border: solid black 1px ;">
                <!-- Input hidden for recuperation of idTicket -->
                <input type="hidden" name="idTicket" value="<?php echo $ligne['idTicket']; ?>">
                <input type="submit" style="margin-top: 80px;" value="Modifier une prestation !!!"></td>
        </form></td>


    </tr>
    <?php } ?>


    </tr>
</table>
