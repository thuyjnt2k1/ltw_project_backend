<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/furlough.php');

$db = new db();
$connect = $db->connect();

$furlough = new Furlough($connect);

$furlough->furloughId = isset($_GET['furloughId']) ? $_GET['furloughId'] : die();


if ($furlough->delete()) {
    echo json_encode(array('message', 'Furlough deleted sucessfully'));
} else {
    echo json_encode(array('message', 'Furlough deleted failed'));
}
?>