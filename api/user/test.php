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
    if($month == "All") {
        if($day == "All")
            $querry = "SELECT *  FROM furlough WHERE employeeId=$id AND YEAR(`requestDate`) = $year AND leaveType = 1";
        else
            $querry = "SELECT *  FROM furlough WHERE employeeId=$id AND DAY(requestDate) = $day AND YEAR(`requestDate`) = $year AND leaveType = 1";
    }
    else {
        if($day == "All")
            $querry = "SELECT *  FROM furlough WHERE employeeId=$id AND MONTH(requestDate) = $month AND YEAR(`requestDate`) = $year AND leaveType = 1";
        else 
            $querry = "SELECT *  FROM furlough WHERE employeeId=$id AND DAY(requestDate) = $day AND MONTH(requestDate) = $month AND YEAR(`requestDate`) = $year AND leaveType = 1";
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
            'furloughId' => $furloughId,
            'requestDate' => $requestDate,
            'leaveType' => $leaveType,
            'reason' => $reason,
            'approvalStatus' => $approvalStatus,
            'employeeId' => $employeeId,
            'leaveFrom' => $leaveFrom,
            'leaveTo' => $leaveTo,

        );
        array_push($return_list['data'], $return_item);
    }
    echo json_encode($return_list, JSON_PRETTY_PRINT);
}

}


?>