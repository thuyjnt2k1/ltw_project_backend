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
$account->employeeId = $data->employeeId;
$account->userType = $data->userType;
$account->accStatus = $data->accStatus;

if ($account->create()) {
    echo json_encode(array('message', 'Account create created sucessfully'));
} else {
    echo json_encode(array('message', 'Account create created failed'));

}
?>