<?php include ("classes/duomenys_class.php"); ?>
<?php 
$duomenys_class = new duomenys_class();
$duomenys_class->createNewUser();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
   
<div>
    <?php
    // tikriname ar užpildyta registracijos forma
    if(isset($_POST["create"])){
       echo "Registracija sėkminga";
       $vardas       = $_POST["vardas"];
       $pavarde      = $_POST["pavarde"];
       $slapyvardis  = $_POST["slapyvardis"];
       $slaptazodis  = $_POST["slaptazodis"];
    
       echo $vardas, " ", $pavarde, " ", $slapyvardis, " ", $slaptazodis;
       $sql="INSERT INTO vartotojai (vardas, pavarde, slapyvardis, teises_ID, slaptazodis, registracijos_data, paskutinis_prisijungimas) VALUES(?,?,?,9,?, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'))";
       $stmtinsert= $sistena->prepare($sql);
       $result = $stmtinsert->execute([$vardas, $pavarde, $slapyvardis, $teises_ID=9, $slaptazodis, $registracijos_data = date('Y-m-d H:i:s'), $paskutinis_prisijungimas = date('Y-m-d H:i:s')]);
       if($result){
        echo "Sėkmingai išsaugota";
       }else {
        echo "Įvyko klaida bandant išsaugoti duomenis";
       }
    }
    ?>
</div>

    <div>
        <form action="registracija.php" method="POST" class="form-disable">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                    <h1>Registracija</h1>
                    <p>Užpildykite duomenis</p>
                    <label for="vardas"><b>Vardas</b></label>
                    <input class="form-control" type="text" name= "vardas" placeholder="Vardas" required>

                    <label for="pavarde"><b>Pavardė</b></label>
                    <input class="form-control" type="text" name= "pavarde" placeholder="Pavardė" required>

                    <label for="slapyvardis"><b>Slapyvardis</b></label>
                    <input class="form-control" type="text" name= "slapyvardis" placeholder="Slapyvardis" required>

                    <label for="slaptazodis"><b>Slaptažodis</b></label>
                    <input class="form-control" type="password" name= "slaptazodis" placeholder="Slaptažodis" required>
                    <hr class="mb-3">

                    <input class="btn btn-primary"type="submit" name="create" value="Registruotis">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="script.js"></script>

<?php 
        //nustatoma default fono spalva
        $spalva = "white";

        //užfiksuojamas mygtuko paspaudimas
        if(isset($_POST["spalva"])) {
            $input_spalva = $_POST["spalva"];
            if($input_spalva == "raudona") {
                $spalva = "red";
            } else if($input_spalva == "geltona") {
                $spalva = "yellow";    
            } else if($input_spalva == "mėlyna") {
                $spalva = "blue";
            } else if($input_spalva == "žalia") {
                $spalva = "green";    
            } else if($input_spalva == "pilka") {
                $spalva = "grey";    
            } else if($input_spalva == "juoda") {
                $spalva = "black";
            } else if($input_spalva == "rožinė") {
                $spalva = "pink";
            } else {
                $spalva = "white";
            }
        }
    ?>
    
    <style>
    body {
        background-color:<?php echo $spalva ?>;
        text-align: right;
    }

    .alert {
        text-align: center;
    }
    </style>
    
<form method="POST" action="registracija.php">
    <input name="spalva"/>
    <button type="submit" name="patvirtinti" class="btn btn-outline-secondary">Pasirinkti fono spalvą</button> 
</form>

<div class="alert alert-info" role="alert">
  Registracija išjungta. <a href="prisijungimas.php" class="alert-link">Prisijungimas</a>. Atsiprašome už nepatogumus!
</div>

</body>
</html>