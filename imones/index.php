

<?php require dirname(__DIR__)."classes/duomenys_class.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Įmonės</title>
</head>
<body>
    
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Pavadinimas</th>
            <th>Tipas_ID</th>
            <th>Aprašymas</th>
            <th>Redaguoti/Ištrinti</th>
        </tr>
        <?php $imones = new duomenys_class(); ?>
        <?php $imones->imonesSelect("imones"); ?>
    </table>


</body>
</html>