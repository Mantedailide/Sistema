<?php require dirname(__DIR__)."classes/duomenys_class.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vartotojai</title>
</head>
<body>


    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Slapyvardis</th>
            <th>Teisės_ID</th>
            <th>Slaptažodis</th>
            <th>Registracijos_data</th>
            <th>Paskutinis_prisijungimas</th>
            <th>Redaguoti/Ištrinti</th>
        </tr>
        <?php $vartotojai = new duomenys_class (); ?>
        <?php $vartotojai->vartotojaiSelect("vartotojai"); ?>

    </table>


</body>
</html>