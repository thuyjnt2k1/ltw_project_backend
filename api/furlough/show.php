<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/furlough.php');

$db = new db();
$connect = $db->connect();

$furlough = new Furlough($connect);

$furlough->furloughId = isset($_GET['furloughId']) ? $_GET['furloughId'] : die();
$furlough->show();

$furlough_item = array(
    'furloughId' => $furlough->furloughId,
    'requestDate' => $furlough->requestDate,
    'leaveType' => $furlough->leaveType,
    'reason' => $furlough->reason,
    'leaveFrom' => $furlough->leaveFrom,
    'leaveTo' => $furlough->leaveTo,
    'approvalStatus' => $furlough->approvalStatus,
    'employeeId' => $furlough->employeeId,
);

echo json_encode($furlough_item, JSON_PRETTY_PRINT);

?>