<?php


header("content-type: application/json");
include '../conn.php';


function register_employee($conn){
    extract($_POST);
    $data = array();
    $query = "INSERT INTO `employee`(`fullname`,`phone`,`emp_type_id`)
     values('$full_name', '$phone','$type')";

    $result = $conn->query($query);


    if($result){

       
            $data = array("status" => true, "data" => "successfully Registered");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function read_all_employe($conn){
    $data = array();
    $array_data = array();
   $query ="SELECT e.emp_id, e.fullname, e.phone, c.Title, e.date_reg FROM employee e JOIN category c on e.emp_type_id=c.id";
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

function read_all_employe_type($conn){
    $data = array();
    $array_data = array();
   $query ="select * from category";
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



function get_employe_info($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT *FROM employee where emp_id= '$emp_id'";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function update_employe($conn){
    
    extract($_POST);
    $data = array();
    $query = "UPDATE employee set fullname = '$full_name', phone = '$phone', emp_type_id= '$type' WHERE emp_id = '$emp_id'";
    $result = $conn->query($query);


    if($result){

            $data = array("status" => true, "data" => "successfully updated ");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function Delete_employe($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM employee where emp_id= '$emp_id'";
    $result = $conn->query($query);


    if($result){
   
        
        $data = array("status" => true, "data" => "successfully Deleted");


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