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

    $data = json_decode(file_get_contents("php://input"));

    $item->brand = $data->brand;
    $item->name = $data->name;
    $item->trim = $data->trim;
    $item->engine = $data->engine;
    $item->origin = $data->origin;
    
    if($item->createCar()){
        echo 'Car created successfully.';
    } else{
        echo 'Car could not be created.';
    }
?>