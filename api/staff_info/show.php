<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/staff_info.php');

$db = new db();
$connect = $db->connect();

$staff_info = new staff_info($connect);

$staff_info->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();
$staff_info->show();


$staff_info_item = array(
    'employeeId' => $staff_info->employeeId,
    'jobTitle' => $staff_info->jobTitle,
    'jobDescription' => $staff_info->jobDescription,
    'department' => $staff_info->department,
    'skill' => $staff_info->skill,
    'hiredDate' => $staff_info->hiredDate,
    'office' => $staff_info->office,
    'education' => $staff_info->education,
    'language' => $staff_info->language,
    'perfomanceReview' => $staff_info->perfomanceReview,
);
echo json_encode($staff_info_item, JSON_PRETTY_PRINT);

?>