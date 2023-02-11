<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/company_dayoff.php');

$db = new db();
$connect = $db->connect();

$company_dayoff = new Company_dayoff($connect);

$data = json_decode(file_get_contents("php://input"));

$company_dayoff->date = $data->date;
$company_dayoff->occasion = $data->occasion;

if ($company_dayoff->create()) {
    echo json_encode(array('message', 'Company_dayoff created sucessfully'));
} else {
    echo json_encode(array('message', 'Company_dayoff created failed'));
}
?>