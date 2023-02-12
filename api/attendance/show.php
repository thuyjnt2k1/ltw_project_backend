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
switch ($attendance->type) {
    case '0':
        $return = 'Chính thức';
        break;
    case '1':
        $return = 'Over time';
        break;
    case '2':
        $return = 'Pending';
        break;
    case '3':
        $return = 'Pending';
        break;
    case '4':
        $return = 'Approved';
        break;
    case '5':
        $return = 'Approved';
        break;
    case '6':
        $return = 'Rejected';
        break;

}
$attendance_item = array(
   
    'attendanceId' => $attendance->attendanceId,
    'type' => $return,
    'outEarlyReason' => $attendance->outEarlyReason,
    'date' => $attendance->date,
    'inTime' => $attendance->inTime,
    'outTime' => $attendance->outTime,
    'employeeId' => $attendance->employeeId,

);
echo json_encode($attendance_item, JSON_PRETTY_PRINT);

?>