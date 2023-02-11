<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/attendance.php');

$db = new db();
$connect = $db->connect();

$attendance = new Attendance($connect);

$attendance->attendanceId = isset($_GET['attendanceId']) ? $_GET['attendanceId'] : die();


if ($attendance->delete()) {
    echo json_encode(array('message', 'Attendance deleted sucessfully'));
} else {
    echo json_encode(array('message', 'Attendance deleted failed'));

}
?>