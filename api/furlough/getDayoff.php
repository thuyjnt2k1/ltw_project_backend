<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');

$db = new db();
$connect = $db->connect();

$id = $_GET['id'];
$day = isset($_GET['day']) ? $_GET['day'] : "All";
$month = isset($_GET['month']) ? $_GET['month']: "All";
$year = isset($_GET['year']) ? $_GET['year'] : "";
$command = $_GET['command'];

if($command == "count") {
    
    $querry = "SELECT SUM(DATEDIFF(leaveTo,leaveFrom)+1) as diff FROM furlough WHERE employeeId=$id AND YEAR(requestDate) = YEAR(CURDATE())";
    $stmt = $connect->prepare($querry);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $return = $result['diff'];
    // while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     $return->data =  $result['days'];
    // }
    
    echo json_encode($return, JSON_PRETTY_PRINT);
}
else if($command == "get") {
    $sum = 0;
    if($day == "All") $sum += 2;
    if($month == "All") $sum += 1;

    $querry = "SELECT *, (DATEDIFF(leaveTo,leaveFrom)+1) as `dayCount`  FROM furlough WHERE employeeId=$id AND YEAR(requestDate) = $year AND leaveType = 1";
    switch($sum) {
        case 2: 
            $querry = $querry." AND MONTH(`requestDate`) = $month";
            break;
        case 1: 
            $querry = $querry." AND DAY(`requestDate`) = $day";
            break;
        case 0:  
            $querry = $querry." AND MONTH(`requestDate`) = $month AND DAY(`requestDate`) = $day";
            break;
    }
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
            // 'furloughId' => $furloughId,
            'requestDate' => $requestDate,
            'leaveType' => $leaveType,
            'reason' => $reason,
            'approvalStatus' => $approvalStatus,
            'employeeId' => $employeeId,
            'leaveFrom' => $leaveFrom,
            'leaveTo' => $leaveTo,
            'dayCount' => $dayCount,

        );
        array_push($return_list['data'], $return_item);
    }
    echo json_encode($return_list, JSON_PRETTY_PRINT);
}

}


?>