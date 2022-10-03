<?php include ("classes/duomenys_class.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prisijungimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<style type="text/css">
    body {
        background-image: url("assets/parrot3.jpg");
        background-size: cover; 
    }

    .alert{
         align-content: center;
    }
    </style>

</head>
<body>
<?php
$duomenys_class = new duomenys_class();
$duomenys_class->login();
?>
<div class="container">
<?php if( isset($_SESSION["arprisijunges"]) && $_SESSION["arprisijunges"] == "prsijunges") { ?>
    <form method="POST" action="prisijungimas.php">
        <button type="submit" name="atsijungti"> Atsijungti </button>
    </form>
<?php } else { ?>
    <br/>
    <br/>
    <form method="POST" action="prisijungimas.php">
        <input name="slapyvardis" placeholder="Slapyvardis" required/>
        <input name="slaptazodis" type="password" placeholder="Slaptažodis" required/>
        <button name="patvirtinti" type="submit" class="btn btn-outline-primary">Prisijungti</button>
    </form>
<?php } ?>
<?php 

    //naršyklė atsimintų kad esame prisijungę
    $slapyvardis = "testas";
    $slaptazodis = "12345";

    //užfiksuojamas mygtuko paspaudimas
    if(isset($_POST["patvirtinti"])) {
        $input_slapyvardis = $_POST["slapyvardis"];
        $input_slaptazodis = $_POST["slaptazodis"];

        if($input_slapyvardis == $slapyvardis && $input_slaptazodis == $slaptazodis ) {
            $_SESSION["arprisijunges"] = "prisijunges";
            header("Location: pagrindinis.php");
        } else {
            header("Location:index.php");
        }
    }

   

?>   
    <form method="POST" action="registracija.php">
        <button name="patvirtinti" type="submit" class="btn btn-outline-primary">Registruotis</button>
    </form>
</div>


<body>

</body>
</html>