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

if ($data->status == 1) {
    if ($data->type == 2) {
        $attendance->type = 4;
        $querry = "DELETE FROM `attendance` WHERE `employeeId` = $data->employeeId AND `date` = '$data->date' AND `type` = 0";
    } else if ($data->type == 3) {
        $attendance->type = 5;
        $querry = "DELETE FROM `attendance` WHERE `employeeId` = $data->employeeId AND `date` = '$data->date' AND `type` = 1";
    }
    echo $querry;
    $stmt = $connect->prepare($querry);
    $stmt->execute();
} else {
    $attendance->type = 6;
}

$attendance->attendanceId = $data->attendanceId;
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