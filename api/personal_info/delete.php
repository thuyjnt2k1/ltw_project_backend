<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/personal_info.php');

$db = new db();
$connect = $db->connect();

$personal_info = new Personal_info($connect);

$personal_info->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();


if ($personal_info->delete()) {
    echo json_encode(array('message', 'Personal_info deleted sucessfully'));
} else {
    echo json_encode(array('message', 'Personal_info deleted failed'));
}
?>