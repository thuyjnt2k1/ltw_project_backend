<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/account.php');
include_once('../../model/staff_info.php');
include_once('../../model/personal_info.php');


$db = new db();
$connect = $db->connect();

$account = new Account($connect);
$staff_info = new staff_info($connect);
$personal_info = new Personal_info($connect);


$data = json_decode(file_get_contents("php://input"));

$account->username = $data->username;
$account->password = isset($data->password) ? $data->password : 's123';
$account->employeeId = $data->employeeId;
$account->userType = $data->userType;
$account->accStatus = $data->accStatus;


$staff_info->employeeId = isset($data->employeeId) ? $data->employeeId : null;
$staff_info->jobTitle = isset($data->jobTitle) ? $data->jobTitle : null;
$staff_info->jobDescription = isset($data->jobDescription) ? isset($data->jobDescription) : null;
$staff_info->department = isset($data->department) ? $data->department : null;
$staff_info->skill = isset($data->skill) ? $data->skill : null;
date_default_timezone_set(date_default_timezone_get());
$curentdate = date('Y/m/d', time());
$staff_info->hiredDate = $curentdate;
$staff_info->office = isset($data->office) ? $data->office : null;
$staff_info->education = isset($data->education) ? $data->education : null;
$staff_info->language = isset($data->language) ? $data->language : null;
$staff_info->perfomanceReview = isset($data->perfomanceReview) ? $data->perfomanceReview : null;

$personal_info->employeeId = isset($data->employeeId) ? $data->employeeId : null;
$personal_info->name = null;
$personal_info->gender = null;
$personal_info->dateOfBirth = null;
$personal_info->birthplace = null;
$personal_info->maritalStatus = null;
$personal_info->email = null;
$personal_info->phone = null;
$personal_info->emergencyPhone = null;
$personal_info->address = null;
$personal_info->imageUrl = null;

if ($account->create() && $staff_info->create() && $personal_info->create()) {
    echo json_encode(array('message', 'Create created sucessfully'));
} else {
    echo json_encode(array('message', 'Create created failed'));
}
?>