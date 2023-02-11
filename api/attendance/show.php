<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/attendance.php');

$db = new db();
$connect = $db->connect();

$attendance = new Attendance($connect);

$attendance->attendanceId = isset($_GET['attendanceId']) ? $_GET['attendanceId'] : die();
$attendance->show();

$attendance_item = array(
    'attendanceId' => $attendance->attendanceId,
    'type' => $attendance->type,
    'outEarlyReason' => $attendance->outEarlyReason,
    'date' => $attendance->date,
    'inTime' => $attendance->inTime,
    'outTime' => $attendance->outTime,
    'employeeId' => $attendance->employeeId,

);
echo json_encode($attendance_item, JSON_PRETTY_PRINT);

?>