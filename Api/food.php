<?php


header("content-type: application/json");
include '../conn.php';

function register_food($conn)
{

    extract($_POST);
    $data = array();
    $query = "INSERT INTO food(`name`,`quantity_in_stock`,`unit_price`)
    values('$name', '$quantity_in_stock','$unit_price')";

    $result = $conn->query($query);


    if ($result) {


        $data = array("status" => true, "data" => "successfully Registered ");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

function read_all_food($conn)
{

    $data = array();
    $array_data = array();
    $query = "SELECT * from food";
    $result = $conn->query($query);


    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $array_data[] = $row;
        }
        $data = array("status" => true, "data" => $array_data);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

function get_foods_info($conn)
{


    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT *FROM food where food_id= '$food_id'";
    $result = $conn->query($query);


    if ($result) {
        $row = $result->fetch_assoc();

        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


function update_food($conn)
{


    extract($_POST);
    $data = array();
    $query = "UPDATE food set name = '$name',quantity_in_stock = '$quantity_in_stock',unit_price = '$unit_price'  WHERE food_id = '$food_id'";
    $result = $conn->query($query);


    if ($result) {

        $data = array("status" => true, "data" => "successfully updated ");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


function Delete_food($conn)
{

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "DELETE FROM food where food_id= '$food_id'";
    $result = $conn->query($query);


    if ($result) {


        $data = array("status" => true, "data" => "successfully Deleted");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $action($conn);
} else {
    echo json_encode(array("status" => false, "data" => "Action Required....."));
}
