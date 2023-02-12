<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/account.php');
include_once('../../model/staff_info.php');


$db = new db();
$connect = $db->connect();

$account = new Account($connect);
$staff_info = new staff_info($connect);


$data = json_decode(file_get_contents("php://input"));

$account->username = $data->username;
$account->password = isset($data->password) ? $data->password: 's123';
$account->employeeId = $data->employeeId;
$account->userType = $data->userType;
$account->accStatus = $data->accStatus;


$staff_info->employeeId = $data->employeeId;
$staff_info->jobTitle = $data->jobTitle;
$staff_info->jobDescription = $data->jobDescription;
$staff_info->department = $data->department;
$staff_info->skill = $data->skill;
date_default_timezone_set(date_default_timezone_get());
$curentdate = date('Y/m/d', time());
$staff_info->hiredDate = $curentdate;
$staff_info->office = $data->office;
$staff_info->education = $data->education;
$staff_info->language = $data->language;
$staff_info->perfomanceReview = $data->perfomanceReview;

if ($account->create() && $staff_info->create()) {
    echo json_encode(array('message', 'Create created sucessfully'));
} else {
    echo json_encode(array('message', 'Create created failed'));

}
?>