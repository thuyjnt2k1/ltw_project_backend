<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/attendance.php');

$db = new db();
$connect = $db->connect();

$attendance = new Attendance($connect);
$read = $attendance->read();

$num = $read->rowCount();
if ($num > 0) {
    $attendance_list = [];
    $attendance_list['data'] = [];

    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $attendance_item = array(
            'attendanceId' => $attendanceId,
            'type' => $type,
            'outEarlyReason' => $outEarlyReason,
            'date' => $date,
            'inTime' => $inTime,
            'outTime' => $outTime,
            'employeeId' => $employeeId,

        );
        array_push($attendance_list['data'], $attendance_item);
    }
    echo json_encode($attendance_list, JSON_PRETTY_PRINT);
}
?>