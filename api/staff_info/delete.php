<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/staff_info.php');

$db = new db();
$connect = $db->connect();

$staff_info = new staff_info($connect);

$staff_info->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();


if ($staff_info->delete()) {
    echo json_encode(array('message', 'staff_info deleted sucessfully'));
} else {
    echo json_encode(array('message', 'staff_info deleted failed'));

}
?>