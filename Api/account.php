<?php


header("content-type: application/json");
include '../conn.php';

function register_account($conn){

    extract($_POST);
    $data = array();
    $query = "INSERT INTO account(`account_number`,`bank`,`balance`)
    values( '$account_number','$bank','$balance')";

    $result = $conn->query($query);


    if($result){

       
            $data = array("status" => true, "data" => "successfully Registered ");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function get_account_info($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT *FROM account where id= '$id'";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function read_all_account($conn){
    $data = array();
    $array_data = array();
   $query ="SELECT * from account";
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


function update_account($conn){
    
    extract($_POST);
    $data = array();
    $query = "UPDATE account set  account_number = '$account_number', bank= '$bank', balance= '$balance' WHERE account_id = '$account_id'";
    $result = $conn->query($query);


    if($result){

            $data = array("status" => true, "data" => "successfully updated ");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function Delete_account($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM account where id= '$id'";
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