<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/account.php');

$db = new db();
$connect = $db->connect();

$account = new Account($connect);
$read = $account->read();

$num = $read->rowCount();
if ($num > 0) {
    $furlough_list = [];
    $furlough_list['data'] = [];

    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $furlough_item = array(
            'username' => $username,
            'password' => $password,
            'employeeId' => $employeeId,
            'userType' => $userType,
            'accStatus' => $accStatus,
        );
        array_push($furlough_list['data'], $furlough_item);
    }
    echo json_encode($furlough_list, JSON_PRETTY_PRINT);
}
?>