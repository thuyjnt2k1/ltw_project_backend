<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/attendance.php');

$db = new db();
$connect = $db->connect();

$data = json_decode(file_get_contents("php://input"));

if($data->command == 'checkin'){
    $data->employeeId = htmlspecialchars(strip_tags($data->id));
    $data->type = htmlspecialchars(strip_tags($data->type));
    $data->inTime = htmlspecialchars(strip_tags($data->inTime));
    date_default_timezone_set(date_default_timezone_get());
    $curentdate = date('Y/m/d', time());
    $data->date = $curentdate;

    $querry = "INSERT INTO `attendance` SET `type`=$data->type, `date`='$data->date', `inTime`='$data->inTime', `employeeId`=$data->employeeId";
    // echo $querry;
    $stmt = $connect->prepare($querry);
    if($stmt->execute()){
        $result = array(
            'response' => '200',
            'message' => 'Successfully!!!'
        );
        echo json_encode($result, JSON_PRETTY_PRINT);
        die();
    }else{
        $result = array(
            'response' => '400',
            'message' => 'Error!!!'
        );
        echo json_encode($result, JSON_PRETTY_PRINT);
        die();
    }
}
else if($data->command == 'checkout'){
    $data->employeeId = htmlspecialchars(strip_tags($data->id));
    $data->outTime = htmlspecialchars(strip_tags($data->outTime));
    $data->outEarlyReason = htmlspecialchars(strip_tags($data->outEarlyReason));
    $querry = "UPDATE attendance SET outTime = '$data->outTime', outEarlyReason = '$data->outEarlyReason' WHERE employeeId = $data->employeeId AND outTime = '00:00:00'";
    $stmt = $connect->prepare($querry);
    // echo $querry;
    if($stmt->execute()){
        $result = array(
            'response' => '200',
            'message' => 'Successfully!!!'
        );
        echo json_encode($result, JSON_PRETTY_PRINT);
        die();
    }else{
        $result = array(
            'response' => '400',
            'message' => 'Error!!!'
        );
        echo json_encode($result, JSON_PRETTY_PRINT);
        die();
    }
}



?>