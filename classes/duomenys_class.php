<?php
include_once 'classes/database_conn_class.php';
// require dirname(__DIR__)."classes/database_conn_class.php";
// include ("classes/database_conn_class.php");

class duomenys_class extends database_conn {
    public $imones;
    public $klientai;
    public $vartotojai;

    public function __construct() {
        parent::__construct();
    }

    public function vartotojaiSelect() {
        $this->vartotojai = $this->selectAction("vartotojai");
        
        if(!isset($_GET["vartotojai"])) {
            foreach ($this->vartotojai as $vartotojas) {
                echo "<tr>";
                echo "<td>".$vartotojas["ID"]."</td>";
                echo "<td>".$vartotojas["vardas"]."</td>";
                echo "<td>".$vartotojas["pavarde"]."</td>";
                echo "<td>".$vartotojas["slapyvardis"]."</td>";
                echo "<td>".$vartotojas["teises_ID"]."</td>";
                echo "<td>".$vartotojas["slaptazodis"]."</td>";
                echo "<td>".$vartotojas["registracijos_data"]."</td>";
                echo "<td>".$vartotojas["paskutinis_prisijungimas"]."</td>";
                echo "<td>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='id' value='".$vartotojas["ID"]."'>";
                echo "<a href='index.php?page=update&id=".$vartotojas["ID"]."' class='btn btn-success btn-sm'>EDIT</a>";
                echo "<button class='btn btn-danger btn-sm' type='submit' name='delete'>DELETE</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
    }

    public function imonesSelect() {
        $this->imones = $this->selectAction("imones");
        
        if(!isset($_GET["company"])) {
            foreach ($this->imones as $imone) {
                echo "<tr>";
                echo "<td>".$imone["ID"]."</td>";
                echo "<td>".$imone["pavadinimas"]."</td>";
                echo "<td>".$imone["tipas_ID"]."</td>";
                echo "<td>".$imone["aprasymas"]."</td>";
                echo "<td>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='id' value='".$imone["ID"]."'>";
                echo "<a href='index.php?page=update&id=".$imone["ID"]."' class='btn btn-success btn-sm'>EDIT</a>";
                echo "<button class='btn btn-danger btn-sm' type='submit' name='delete'>DELETE</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";

            }
        }
    }

    public function klientaiSelect() {
        $this->klientai = $this->selectAction("klientai");
        
        if(!isset($_GET["clients"])) {
            foreach ($this->klientai as $klientas) {
                echo "<tr>";
                echo "<td>".$klientas["ID"]."</td>";
                echo "<td>".$klientas["vardas"]."</td>";
                echo "<td>".$klientas["pavarde"]."</td>";
                echo "<td>".$klientas["teises_id"]."</td>";
                echo "<td>".$klientas["aprasymas"]."</td>";
                echo "<td>".$klientas["imones_id"]."</td>";
                echo "<td>".$klientas["pridejimo_data"]."</td>";
                echo "<td>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='id' value='".$klientas["ID"]."'>";
                echo "<a href='index.php?page=update&id=".$klientas["ID"]."' class='btn btn-success btn-sm'>EDIT</a>";
                echo "<button class='btn btn-danger btn-sm' type='submit' name='delete'>DELETE</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";

            }
        }
    }

    public function addNewUser($vardas,$pavarde,$slapyvardis,$slaptazodis) {
        $timestamp = date("Y-m-d");
        $teisesID=4;
        $vartotojas=array(
            "vardas"=>$vardas,
            "pavarde"=>$pavarde,
            "slapyvardis"=>$slapyvardis,
            "slaptazodis"=>$slaptazodis,
            "teises_ID"=>$teisesID,
            "registracijos_data"=>$timestamp,
        );
            $this->insertAction("vartotojai", ["vardas","pavarde","slapyvardis","slaptazodis","teises_ID","registracijos_data"], ["'".$vartotojas["vardas"]."'", "'".$vartotojas["pavarde"]."'", "'".$vartotojas["slapyvardis"]."'",  "'".$vartotojas["slaptazodis"]."'",   "'".$vartotojas["teises_ID"]."'" ,"'".$vartotojas["registracijos_data"]."'"]);
            header("location: vartotojai/registracija.php");
        } 
    

    public function createNewUser() {

        if(isset($_POST["registrate"])) {
            $vardas=$_POST["vardas"];
            $pavarde=$_POST["pavarde"];
            $slapyvardis=$_POST["slapyvardis"];
            $slaptazodis=$_POST["slaptazodis"];

           $tikrinamasvardas=$vardas;
           $tikrinamaspavarde=$pavarde;
           $tikrinamasslapyvardis=$slapyvardis;
           $tikrinamasslaptazodis=$slaptazodis;

           $existingUser=$this->checkUsername("vartotojai",$slapyvardis);
           
            if($tikrinamasvardas=="" OR $tikrinamaspavarde=="" OR $tikrinamasslapyvardis=="" OR $tikrinamasslaptazodis=="") {
                header("location: prisijungimas.php");
            } else if($existingUser==1) {
                header("location: vartotojai/index.php");
            } else {
                $this->addNewUser($vardas,$pavarde,$slapyvardis,$slaptazodis);
            }
        }
    }

    public function login() {
        if(isset($_POST["login"])) {
            $username=$_POST["slapyvardis"];
            $password=$_POST["slaptazodis"];

           $logInSuccessfull = $this->loginto("vartotojai",$username,$password);

           if($logInSuccessfull == 1) {
            header("location: pagrindinis.php");
           } else {
            header("location: prisijungimas.php");
           }
        } 
    }

    public function __destruct() {
        $this->conn = null;
    }
}
?>