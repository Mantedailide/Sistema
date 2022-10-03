<?php 
class database_conn {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "sistema";

    protected $conn; //connection kad sita savybe galetu naudotis kitos klases

    //Konstruktoriaus funkcija - pasileidzia automatiskai objektui susikurus/ivykdzius objekto metoda
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
           echo "Prisijungta prie duomenų bazės sėkmingai";
        } catch(PDOException $e) {
           echo "Prisijungti prie duomenų bazės nepavyko: " . $e->getMessage();
        }
    }

    public function selectAction($table, $col ="id", $sortDir ="ASC") {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table` WHERE 1 ORDER BY $col $sortDir";
            //pasiruošimas vykdyti
            $stmt = $this->conn->prepare($sql);
            //vykdyti
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;

        } catch(PDOException $e) {
            return "Nepavyko įvykdyti užklausos: " . $e->getMessage();
        }
    }
    //$cols - iterpiami stulpeliai, masyvas
    //$values - stulpeliu reiksmes, masyvas

    //kategorijos
    // $cols = ["title", "description"];
    // $values = ["'test'", "'test'"];['"test"', '"test"']

    //filmai
    // $cols = ["title", "description","image", "kategorijosID];
    // $values = ["test", "test", "test", "test"];
    public function insertAction($table, $cols, $values) {
        $cols = implode(",", $cols);
        //masyva pavercia i teksta per skirtuka ["title", "description"] => "title,description"
        $values = implode(",", $values);//  ["test", "test"] => "test,test"

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql= "INSERT INTO `$table` ($cols) VALUES ($values)";
            $this->conn->exec($sql);
            echo "Pavyko sukurti naują įrašą";

        } catch (PDOException $e) {
            echo "Nepavyko sukurti naujo įrašo: " . $e->getMessage();
        }
    }

    public function loginto($table,$username,$password) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table` WHERE slapyvardis = '$username' and slaptazodis = '$password'";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $count = count($result);

            return $count;

        } catch (PDOException $e) {
            echo "<h1> Prisijungti nepavyko, klaidingi duomenys.</h1>: " . $e->getMessage();
        }
    }

    public function checkUsername($table,$slapyvardis) {

        //pirma pasitikrinam ar sitas sql veikia gerai
        //truksta dar $table
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //cia turi buti stulpeliu pavadinimai tokie kaip duomenu bazeje
            $sql = "SELECT * FROM `$table` WHERE slapyvardis = '$slapyvardis'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $count = count($result);
            return $count;

        } catch (PDOException $e) {
            echo "<h1> Prisijungti nepavyko, klaidingi duomenys.</h1>: " . $e->getMessage();
        }
    }

    public function deleteAction($table, $id) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `$table` WHERE id = $id";
            $this->conn->exec($sql);
            echo "Įrašas ištrintas";
        }
        catch(PDOException $e) {
            echo "Nepavyko ištrinti įrašo: " . $e->getMessage();
        }
    }

    public function updateAction($table, $id, $data) {
        $cols = array_keys($data);
        $values = array_values($data);

        $dataString = [];
        for ($i=0; $i<count($cols); $i++) {
           $dataString[] = $cols[$i] . " = '" . $values[$i]. "'";
        }
        $dataString = implode(",", $dataString);

       try{
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "UPDATE `$table` SET $dataString WHERE id = $id";
              $stmt = $this->conn->prepare($sql);
              $stmt->execute();
              echo "Įrašas atnaujintas";
         } 
       catch(PDOException $e) {
              echo "Nepavyko atnaujinti įrašo: " . $e->getMessage();
       }
    }

    public function selectOneAction($table, $id) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table` WHERE id = $id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e) {
            return "Nepavyko įvykdyti užklausos: " . $e->getMessage();
        }
    }

    public function selectWithJoin($table1, $table2, $table1RelationCol, $table2RelationCol, $join, $cols) {
        //table1 - filmai
        //table2 - kategorijos

        //sujungimo stulpeliai

        //daznu atveju reikia pasirinkti konkrecius stulpelius
        // tenka pervadinti stulpelius

        //$table1 = "filmai";
        //$table2 = "kategorijos";

        //$table1RelationCol = "kategorijosID";
        //$table2RelationCol = "id";

        //$join = "LEFT JOIN";

        //$cols = ["filmai.id", "filmai.title", "filmai.description", "filmai.image", "kategorijos.title as categoryTitle"];

        $cols = implode(",", $cols); // "filmai.id, filmai.title, filmai.description, filmai.image, kategorijos.title as categoryTitle"

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT $cols FROM $table1 
            $join $table2
            ON $table1.$table1RelationCol = $table2.$table2RelationCol";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            return "Nepavyko įvykdyti užklausos: " . $e->getMessage();
        }
    }

    //Destruktoriaus funkcija - pasileidzia automatiskai po objekto sunaikinimo/ ir po objekto metodo ivykdymo
    public function __destruct() {
        $this->conn = null;
    "Atjungta iš duomenų bazės sėkmingai";
    }
}

?>