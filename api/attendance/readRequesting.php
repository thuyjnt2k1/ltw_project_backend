<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/attendance.php');

$db = new db();
$connect = $db->connect();

$attendance = new Attendance($connect);
$read = $attendance->readRequesting();

$num = $read->rowCount();
if ($num > 0) {
    $attendance_list = [];
    $attendance_list['data'] = [];
    $return = '';
    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        switch ($type) {
            case '0':
                $return = 'Office';
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
            'attendanceId' => $attendanceId,
            'type' => $type,
            'outEarlyReason' => $outEarlyReason,
            'date' => $date,
            'inTime' => $inTime,
            'outTime' => $outTime,
            'employeeId' => $employeeId,
            'status' => $return
        );
        array_push($attendance_list['data'], $attendance_item);
    }
    echo json_encode($attendance_list, JSON_PRETTY_PRINT);
}
?>

