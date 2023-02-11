<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/account.php');

$db = new db();
$connect = $db->connect();

$account = new Account($connect);

$account->employeeId = isset($_GET['employeeId']) ? $_GET['employeeId'] : die();
$account->show();

$furlough_item = array(
    'username' => $account->username,
    'password' => $account->password,
    'employeeId' => $account->employeeId,
    'userType' => $account->userType,
    'accStatus' => $account->accStatus,
);

echo json_encode($furlough_item, JSON_PRETTY_PRINT);

?>