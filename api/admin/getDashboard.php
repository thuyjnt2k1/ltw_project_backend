<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');

$db = new db();
$connect = $db->connect();

$querry = "SELECT employeeId, name, totalTime, month, year FROM personal_info as p INNER JOIN (SELECT SUM(TIMESTAMPDIFF(HOUR, inTime,`outTime`)) as totalTime, MONTH(date) as month, YEAR(date) as year, employeeId as id FROM attendance GROUP BY employeeId, MONTH(date), YEAR(date)) as time ON p.employeeId = time.id ";
$data = json_decode(file_get_contents("php://input"));

$check = 0;
if(!empty($data->employeeId)){
    if($check == 0){
        $querry = $querry . "WHERE employeeId = " . $data->employeeId . " ";
        $check = 1;
    }
}

if(!empty($data->month)){
    if($check == 0){
        $querry = $querry . "WHERE month = " . $data->month . " ";
    }else{
        $querry = $querry . "AND month = " . $data->month . " ";
    }
    $check = 1;
}

if(!empty($data->year)){
    if($check == 0){
        $querry = $querry . "WHERE year = " . $data->year . " ";
    }else{
        $querry = $querry . "AND year = " . $data->year . " ";
    }
    $check = 1;
}

// echo $querry;



$stmt = $connect->prepare($querry);
$stmt->execute();
$return = new stdClass;

$num = $stmt->rowCount();
if ($num > 0) {
    $return_list = [];
    $return_list['data'] = [];

    while ($return = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($return);
        $return_item = array(
            'employeeId' => $employeeId,
            'month' => $month,
            'year' => $year,
            'name' => $name,
            'totalTime' => $totalTime
        );
        array_push($return_list['data'], $return_item);
    }
    echo json_encode($return_list, JSON_PRETTY_PRINT);
}

?>