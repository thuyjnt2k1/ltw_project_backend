<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/furlough.php');

$db = new db();
$connect = $db->connect();

$furlough = new Furlough($connect);

$data = json_decode(file_get_contents("php://input"));

$furlough->furloughId = $data->furloughId;
$furlough->requestDate = $data->requestDate;
$furlough->leaveType = $data->leaveType;
$furlough->reason = $data->reason;
$furlough->leaveFrom = $data->leaveFrom;
$furlough->leaveTo = $data->leaveTo;
$furlough->approvalStatus = $data->approvalStatus;
$furlough->employeeId = $data->employeeId;





if ($furlough->create()) {
    echo json_encode(array('message', 'Furlough create created sucessfully'));
} else {
    echo json_encode(array('message', 'Furlough create created failed'));

}
?>