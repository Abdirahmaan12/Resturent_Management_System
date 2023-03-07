<?php


header("content-type: application/json");
include '../conn.php';


function register_payment($conn)
{
    extract($_POST);
    $data = array();
    $query = "INSERT INTO paymant (customer_id,food_id,account_id,amount)
     values('$customer_id', '$food_id','$account_id', '$amount')";

    $result = $conn->query($query);


    if ($result) {


        $data = array("status" => true, "data" => "successfully Registered ");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


function read_all_orders($conn)
{
    $data = array();
    $array_data = array();
    $query = "SELECT food_id ,name from food";
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



function read_all_payment($conn)
{
    $data = array();
    $array_data = array();
    $query = "SELECT p.paymant_id, c.frist_name as customer_name, pr.name as food_name, a.bank as bank_name, p.amount, p.paymant_date from paymant p JOIN customers c on p.customer_id= c.customer_id JOIN food pr on p.food_id= pr.food_id JOIN account a on 
   p.account_id=a.id";
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

function read_all_employe_type($conn)
{
    $data = array();
    $array_data = array();
    $query = "select * from emp_type";
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



function get_payment($conn)
{
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT *FROM paymant where paymant_id= '$paymant_id'";
    $result = $conn->query($query);


    if ($result) {
        $row = $result->fetch_assoc();

        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


function update_payment($conn)
{

    extract($_POST);
    $data = array();
    $query = "UPDATE paymant set customer_id = '$customer_id',  food_id= '$food_id',account_id = '$account_id', 
    amount= '$amount' WHERE paymant_id = '$paymant_id'";
    $result = $conn->query($query);


    if ($result) {

        $data = array("status" => true, "data" => "successfully updated ");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


function Delete_payments($conn)
{
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "DELETE FROM paymant where paymant_id= '$paymant_id'";
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
