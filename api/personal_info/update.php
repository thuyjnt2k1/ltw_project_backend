<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/personal_info.php');

$db = new db();
$connect = $db->connect();

$personal_info = new Personal_info($connect);

$data = json_decode(file_get_contents("php://input"));

$personal_info->employeeId = $data->employeeId;
$personal_info->name = $data->name;
$personal_info->gender = $data->gender;
$personal_info->dateOfBirth = $data->dateOfBirth;
$personal_info->birthplace = $data->birthplace;
$personal_info->maritalStatus = $data->maritalStatus;
$personal_info->email = $data->email;
$personal_info->phone = $data->phone;
$personal_info->emergencyPhone = $data->emergencyPhone;
$personal_info->address = $data->address;
$personal_info->imageUrl = $data->imageUrl;



if ($personal_info->update()) {
    echo json_encode(array('message', 'Personal_info update sucessfully'));
} else {
    echo json_encode(array('message', 'Personal_info update failed'));

}
?>