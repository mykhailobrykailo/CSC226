<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/employees.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Car($db);

    $item->year = isset($_GET['year']) ? $_GET['year'] : die();
  
    $item->getSingleCar();

    if($item->brand != null){
        // create array
        $emp_arr = array(
            "year" =>  $item->year,
            "brand" => $item->brand,
            "name" => $item->name,
            "trim" => $item->trim,
            "engine" => $item->engine,
            "origin" => $item->origin
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Car not found.");
    }
?>