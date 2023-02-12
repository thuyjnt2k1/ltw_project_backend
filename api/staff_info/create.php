<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/staff_info.php');

$db = new db();
$connect = $db->connect();

$staff_info = new staff_info($connect);

$data = json_decode(file_get_contents("php://input"));

$staff_info->employeeId = $data->employeeId;
$staff_info->jobTitle = $data->jobTitle;
$staff_info->jobDescription = $data->jobDescription;
$staff_info->department = $data->department;
$staff_info->skill = $data->skill;
$staff_info->hiredDate = $data->hiredDate;
$staff_info->office = $data->office;
$staff_info->education = $data->education;
$staff_info->language = $data->language;
$staff_info->perfomanceReview = $data->perfomanceReview;

if ($staff_info->create()) {
    echo json_encode(array('message', 'staff_info created sucessfully'));
} else {
    echo json_encode(array('message', 'staff_info created failed'));

}
?>