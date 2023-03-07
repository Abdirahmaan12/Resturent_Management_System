<?php
header("content-type: application/json");
include '../conn.php';
// $action = $_POST['action'];

function register_charge($conn){
    extract($_POST);
    $data = array();
    $query = "CALL charge_month('$month', '$year', '$description', '$user', '$account_id')";

    $result = $conn->query($query);


    if($result){

        $row= $result->fetch_assoc();
        if($row['message']== 'Deny'){
            $data = array("status" => false, "data" => "Insuficance Balance😜");



        }elseif($row['message']== 'Registered'){
            $data = array("status" => true, "data" => "Registered succesfully 😂😊😒😎");



        }elseif($row['message']== 'NOt'){
            $data = array("status" => false, "data" => "Horay Ayaa loogu dalacay lacagta bishaan', '$month' Sanadkaan '$year'");


        }


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function read_all_charge($conn){
    $data = array();
    $array_data = array();
   $query ="SELECT c.id, e.fullname  as Employe_name, ca.Title,c.Amount, ac.bank as bank_name, c.Month, c.Year, c.Description, u.username,c.Date from charge c JOIN Employee e on c.Employee=e.emp_id JOIN category ca on c.Category=ca.id JOIN account ac ON
   c.Account_id=ac.id JOIN users u on c.User_id=u.user_id";
    $result = $conn->query($query);


    if($result){
        while($row = $result->fetch_assoc()){
            $array_data[] = $row;
        }
        $data = array("status" => true, "data" => $array_data);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}



function get_allusers($conn){

    $data = array();
    $array_data = array();
   $query ="select * from users";
    $result = $conn->query($query);


    if($result){
        while($row = $result->fetch_assoc()){
            $array_data[] = $row;
        }
        $data = array("status" => true, "data" => $array_data);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}





if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data"=> "Action Required....."));
}


?>