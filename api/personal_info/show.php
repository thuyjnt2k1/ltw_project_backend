<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/personal_info.php');

$db = new db();
$connect = $db->connect();

$personal_info = new Personal_info($connect);

$personal_info->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();
$personal_info->show();

$personal_info = array(
    'employeeId' => $personal_info->employeeId,
    'name' => $personal_info->name,
    'gender' => $personal_info->gender,
    'dateOfBirth' => $personal_info->dateOfBirth,
    'birthplace' => $personal_info->birthplace,
    'maritalStatus' => $personal_info->maritalStatus,
    'email' => $personal_info->email,
    'phone' => $personal_info->phone,
    'emergencyPhone' => $personal_info->emergencyPhone,
    'address' => $personal_info->address,
    'imageUrl' => $personal_info->imageUrl,

);

echo json_encode($personal_info, JSON_PRETTY_PRINT);

?>