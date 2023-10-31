<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/employees.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Car($db);

    $stmt = $items->getCar();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "year" => $year,
                "brand" => $brand,
                "name" => $name,
                "trim" => $trim,
                "engine" => $engine,
                "origin" => $origin
            );

            array_push($employeeArr["body"], $e);
        }
        echo json_encode($employeeArr);
    }


    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>