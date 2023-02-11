<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/attendance.php');

$db = new db();
$connect = $db->connect();

$attendance = new Attendance($connect);

$data = json_decode(file_get_contents("php://input"));

$attendance->attendanceId = $data->attendanceId;
$attendance->type = $data->type;
$attendance->outEarlyReason = $data->outEarlyReason;
$attendance->date = $data->date;
$attendance->inTime = $data->inTime;
$attendance->outTime = $data->outTime;
$attendance->employeeId = $data->employeeId;

if ($attendance->update()) {
    echo json_encode(array('message', 'Atandance update sucessfully'));
} else {
    echo json_encode(array('message', 'Atandance update failed'));

}
?>