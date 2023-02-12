<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/account.php');

$db = new db();
$connect = $db->connect();

$account = new Account($connect);

$data = json_decode(file_get_contents("php://input"));

$account->username = $data->username;
$account->password = $data->password;
$account->employeeId = $data->username;
$account->userType = 0;
$account->accStatus = 0;

$run = $connect->prepare("SELECT `username` FROM `account` ");
$run->execute();
$return = new stdClass;

$num = $run->rowCount();
if ($num > 0) {
    $return_list = [];
    $return_list['data'] = [];

    while ($return = $run->fetch(PDO::FETCH_ASSOC)) {
        extract($return);
        if ($account->username == $username) {
            echo json_encode(array('Username has been already existed'));
            die();
        }
    }
}

if ($account->create()) {
    $querry = "INSERT INTO `personal_info` (`employeeId`) VALUES ('$account->employeeId');";
    $stmt = $connect->prepare($querry);
    $stmt->execute();

    $querry = "INSERT INTO `staff_info` (`employeeId`) VALUES ('$account->employeeId');";
    $stmt = $connect->prepare($querry);
    $stmt->execute();
    echo json_encode(array('Register sucessfully!!!'));
} else {
    echo json_encode(array('Register failed!!!'));
}
;
?>