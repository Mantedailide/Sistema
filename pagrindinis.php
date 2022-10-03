<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href="assets/style.css" rel="stylesheet">
    <title>Prisijungimas</title>
</head>
<body>
<style type="text/css">
    body {
        background-image: url("assets/parrot4.jpg");
        background-size: cover; 
    }

    .nav .nav-item .nav-link {
    color:rgb(42, 161, 82);
    font-weight: bolder;
    }
</style>
    <div class="container">
    <h1>Sėkmingai prisijungėte!</h1>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="pagrindinis.php">Pagrindinis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="vartotojai/index.php">Vartotojai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="klientai/index.php">Klientai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="imones/index.php">Įmonės</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-outline-secondary" role="button" href="prisijungimas.php">Atsijungti</a>
            </li>
        </ul>
        <?php 
            //pagal GET kintamąjį mes būsime nukreipiami į tam tikrus puslapius
        
            if(isset($_GET["page"])) {
                if(($_GET["page"]) == "vartotojai") {
                    include("valdymas/vartotojai.php");
                } else if(($_GET["page"]) == "company") {
                    include("valdymas/imones.php");
                } else if(($_GET["page"]) == "clients") {
                    include("valdymas/klientai.php");
                } else if(($_GET["page"]) == "pagrindinis") {
                    include("valdymas/main.php");
                } else if(($_GET["page"]) == "logout") {
                    
                    include("vartotojai/index.php");
                } else {
                    include("valdymas/main.php");
                }
            }

        ?>
    </div>
</body>
</html>