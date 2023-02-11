<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/account.php');

$db = new db();
$connect = $db->connect();

$account = new Account($connect);

$account->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();


if ($account->delete()) {
    echo json_encode(array('message', 'Account deleted sucessfully'));
} else {
    echo json_encode(array('message', 'Account deleted failed'));
}
?>