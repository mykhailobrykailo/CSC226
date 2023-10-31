<?php
    class Car{

        // Connection
        private $conn;

        // Table
        private $db_table = "Employee";

        // Columns
        public $year;
        public $brand;
        public $name;
        public $trim;
        public $engine;
        public $origin;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCar(){
            $sqlQuery = "SELECT year,brand, name, trim, engine, origin FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createCar(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        brand = :brand, 
                        name = :name, 
                        trim = :trim, 
                        engine = :engine, 
                        origin = :origin";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->brand=htmlspecialchars(strip_tags($this->brand));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->trim=htmlspecialchars(strip_tags($this->trim));
            $this->engine=htmlspecialchars(strip_tags($this->engine));
            $this->origin=htmlspecialchars(strip_tags($this->origin));
        
            // bind data
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":trim", $this->trim);
            $stmt->bindParam(":engine", $this->engine);
            $stmt->bindParam(":origin", $this->origin);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleCar(){
            $sqlQuery = "SELECT
                        year, 
                        brand, 
                        name, 
                        trim, 
                        engine, 
                        origin
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       year = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->year);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['brand'];
            $this->trim = $dataRow['name'];
            $this->year = $dataRow['trim'];
            $this->engine = $dataRow['engine'];
            $this->origin = $dataRow['origin'];
        }        

        // UPDATE
        public function updateCar(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        brand = :brand, 
                        name = :name, 
                        trim = :trim, 
                        engine = :engine, 
                        origin = :origin
                    WHERE 
                        year = :year";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->brand=htmlspecialchars(strip_tags($this->brand));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->trim=htmlspecialchars(strip_tags($this->trim));
            $this->engine=htmlspecialchars(strip_tags($this->engine));
            $this->origin=htmlspecialchars(strip_tags($this->origin));
            $this->year=htmlspecialchars(strip_tags($this->year));
        
            // bind data
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":trim", $this->trim);
            $stmt->bindParam(":engine", $this->engine);
            $stmt->bindParam(":origin", $this->origin);
            $stmt->bindParam(":year", $this->year);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteCar(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE year = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->year=htmlspecialchars(strip_tags($this->year));
        
            $stmt->bindParam(1, $this->year);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

