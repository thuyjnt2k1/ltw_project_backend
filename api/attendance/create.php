<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/attendance.php');

$db = new db();
$connect = $db->connect();

$attendance = new Attendance($connect);

$data = json_decode(file_get_contents("php://input"));

// $attendance->attendanceId = $data->count;
$attendance->type = $data->type == "overtime" ? 1 : 0;
$attendance->outEarlyReason = $data->outEarlyReason;
$attendance->date = $data->date;
$attendance->inTime = $data->inTime;
$attendance->outTime = isset($data->outTime) ? $data->outTime : "00:00:00";
$attendance->employeeId = $data->id;


if ($attendance->create()) {
    echo json_encode(array('message', 'Atandance created sucessfully'));
} else {
    echo json_encode(array('message', 'Atandance created failed'));

}
?>