<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');

$db = new db();
$connect = $db->connect();

$querry = "SELECT a.employeeId, a.username, s.department, a.accStatus, a.userType, s.hiredDate FROM account as a INNER JOIN staff_info as s ON a.employeeId=s.employeeId ";

$data = json_decode(file_get_contents("php://input"));

$check = 0;
if(isset($data->employeeId)){
    if($check == 0){
        $querry = $querry . "WHERE a.employeeId = '" . $data->employeeId . "' ";
        $check = 1;
    }
}

if(isset($data->username)){
    if($check == 0){
        $querry = $querry . "WHERE a.username = '" . $data->username . "' ";
    }else{
        $querry = $querry . "AND a.username = '" . $data->username . "' ";
    }
    $check = 1;
}

if(isset($data->department)){
    if($check == 0){
        $querry = $querry . "WHERE s.department = '" . $data->department . "' ";
    }else{
        $querry = $querry . "AND s.department = '" . $data->department . "' ";
    }
    $check = 1;
}

if(isset($data->accStatus)){
    if($check == 0){
        $querry = $querry . "WHERE a.accStatus = '" . $data->accStatus . "' ";
    }else{
        $querry = $querry . "AND a.accStatus = '" . $data->accStatus . "' ";
    }
    $check = 1;
}
// echo $querry;



$stmt = $connect->prepare($querry);
$stmt->execute();
$return = new stdClass;

$num = $stmt->rowCount();
if ($num > 0) {
    $return_list = [];
    $return_list['data'] = [];

    while ($return = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($return);
        $return_item = array(
            'employeeId' => $employeeId,
            'username' => $username,
            'department' => $department,
            'userType' => $userType,
            'accStatus' => $accStatus,
            'hiredDate' => $hiredDate,
        );
        array_push($return_list['data'], $return_item);
    }
    echo json_encode($return_list, JSON_PRETTY_PRINT);
}

?>