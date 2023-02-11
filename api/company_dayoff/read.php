<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/company_dayoff.php');

$db = new db();
$connect = $db->connect();

$company_dayoff = new Company_dayoff($connect);
$read = $company_dayoff->read();

$num = $read->rowCount();
if ($num > 0) {
    $attendance_list = [];
    $attendance_list['data'] = [];

    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $attendance_item = array(
            'date' => $date,
            'occasion' => $occasion,
        );
        array_push($attendance_list['data'], $attendance_item);
    }
    echo json_encode($attendance_list, JSON_PRETTY_PRINT);
}
?>