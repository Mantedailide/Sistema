
<?php include ("classes/duomenys_class.php"); ?>
<?php include ("classes/ddatabase_conn_class.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Pradžia</title>
</head>
<body>

<style type="text/css">
    body {
        background-image: url("assets/parrot1.jpg");
        background-size: cover; 
    }
</style>
    <div class="container">
        <h1>Sveiki atvykę!</h1>
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="registracija.php">Registracija</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="prisijungimas.php">Prisijungti</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Pagrindinis</a>
            </li>
        </ul>   
        <?php 
        
            if(isset($_GET["page"])) {
                // 1 = įjungta ; 0 = išjungta
                $registracijos_forma=1;

                if(($_GET["page"]) == "prisijungti") {
                    include("baigiamasis_darbas/prisijungimas.php");
                } else if(($_GET["page"]) == "registruotis" && $registracijos_forma=0) {
                    include("baigiamasis_darbas/registracija.php");
                } else if(($_GET["page"]) == "registruotis" && $registracijos_forma==1) {
                    include("baigiamasis_darbas/pagrindinis.php");
                } else if(($_GET["page"]) == "pagrindinis") {
                    include("baigiamasis_darbas/index.php");
                } else {
                    include("vartotojai/index.php");
                }
            }

        ?>
    </div>


</body>
</html>