<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');

$db = new db();
$connect = $db->connect();

$querry = "SELECT SUM(DATEDIFF(`leaveTo`, `leaveFrom`)+1) AS days FROM `furlough` WHERE YEAR(`requestDate`) = YEAR(CURDATE()) AND `leaveType` = 1;
";
$stmt = $connect->prepare($querry);
$stmt->execute();
$return = new stdClass;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $return->data =  $result['days'];
}


echo json_encode($return, JSON_PRETTY_PRINT);

?>