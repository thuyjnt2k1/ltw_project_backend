<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/company_dayoff.php');

$db = new db();
$connect = $db->connect();

$company_dayoff = new Company_dayoff($connect);

$company_dayoff->date = isset($_GET['date']) ? $_GET['date'] : die();


if ($company_dayoff->delete()) {
    echo json_encode(array('message', 'Company dayoff deleted sucessfully'));
} else {
    echo json_encode(array('message', 'Company dayoff deleted failed'));

}
?>