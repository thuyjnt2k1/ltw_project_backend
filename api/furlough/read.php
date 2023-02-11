<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/furlough.php');

$db = new db();
$connect = $db->connect();

$furlough = new Furlough($connect);
$read = $furlough->read();

$num = $read->rowCount();
if ($num > 0) {
    $furlough_list = [];
    $furlough_list['data'] = [];

    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $furlough_item = array(
            'furloughId' => $furloughId,
            'requestDate' => $requestDate,
            'leaveType' => $leaveType,
            'reason' => $reason,
            'leaveFrom' => $leaveFrom,
            'leaveTo' => $leaveTo,
            'approvalStatus' => $approvalStatus,
            'employeeId' => $employeeId,



        );
        array_push($furlough_list['data'], $furlough_item);
    }
    echo json_encode($furlough_list, JSON_PRETTY_PRINT);
}
?>