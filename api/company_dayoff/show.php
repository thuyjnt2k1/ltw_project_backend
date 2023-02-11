<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/company_dayoff.php');

$db = new db();
$connect = $db->connect();

$company_dayoff = new Company_dayoff($connect);

$company_dayoff->occasion = isset($_GET['occasion']) ? $_GET['occasion'] : die();
$company_dayoff->show();

$attendance_item = array(
    'date' => $date,
    'occasion' => $occasion,
);
echo json_encode($attendance_item, JSON_PRETTY_PRINT);

?>