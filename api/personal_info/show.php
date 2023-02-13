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

$res = array(
    'employeeId' => $personal_info->employeeId,
    'name' => $personal_info->name,
    'dateOfBirth' => $personal_info->dateOfBirth,
    'birthplace' => $personal_info->birthplace,
    // 'maritalStatus' => $personal_info->maritalStatus,
    'email' => $personal_info->email,
    'phone' => $personal_info->phone,
    'emergencyPhone' => $personal_info->emergencyPhone,
    'address' => $personal_info->address,
    'imageUrl' => $personal_info->imageUrl,

);
$res['gender'] = ($personal_info->gender == 0 ? "Nữ" : "Nam");
switch($personal_info->maritalStatus) {
    case 0: $res['maritalStatus'] = "Độc thân"; break;
    case 1: $res['maritalStatus'] = "Đã kết hôn"; break;
    case 2: $res['maritalStatus'] = "Đã li dị"; break;
}
// $res['maritua']
// $personal_info['gender'] = ()

echo json_encode($res, JSON_PRETTY_PRINT);

?>