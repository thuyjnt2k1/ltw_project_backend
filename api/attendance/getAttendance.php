<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
// header('Access-Control-Allow-Methods:GET');
// header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/attendance.php');

$db = new db();
$connect = $db->connect();

$attendance = new Attendance($connect);

// $data = json_decode(file_get_contents("php://input"));
// echo 1;

// print_r($_GET['id']);
// echo $_GET['day'].$_GET['month'].$_GET['year'];

$id = $_GET['id'];
$day = isset($_GET['day']) ? $_GET['day'] : "";
$month = isset($_GET['month']) ? $_GET['month']: "";
$year = isset($_GET['year']) ? $_GET['year'] : "";
$command = $_GET['command'];

if($command == "search") {
    $res = $attendance->getOne($id, $day, $month, $year);

    $num = $res->rowCount();
    if ($num > 0) {
        $attendance_list = [];
        $attendance_list['data'] = [];
    
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $workHour = round($row['workTime'] / 60);
            $workMinute = $row['workTime'] % 60;
            $outEarlyReason = $row['outEarlyReason'];
            $type = $row['type'];
            $attendance_item = array(
                // 'attendanceId' => $attendanceId,
                // 'type' => $type,
                'outEarlyReason' => $outEarlyReason,
                'date' => $date,
                'inTime' => $inTime,
                'outTime' => $outTime,
                'employeeId' => $employeeId,
    
            );
            $attendance_item['outEarlyReason'] = $outEarlyReason ? $outEarlyReason : "---";
            $attendance_item['workTime'] = $workHour.":".($workMinute < 10 ? '0'.$workMinute : $workMinute );
            $attendance_item['type'] = $type ? "OT" : "Official";
            array_push($attendance_list['data'], $attendance_item);
        }
        echo json_encode($attendance_list, JSON_PRETTY_PRINT);
        // print_r($attendance_list['data']);
    }
}
else if($command == "now") {

    $res = $attendance->getMy($id);
    $items = [];

    $num = $res['today']->rowCount();
    if($num > 0) {
        $row = $res['today']->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $items['today'] = ($row['workTime'] ? $row['workTime'] : 0);
        
    }
    else $items['today'] = 0;
    

    $num = $res['thisMonth']->rowCount();
    if($num > 0) {
        $row = $res['thisMonth']->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $items['thisMonth'] = ($row['workTime'] ? $row['workTime'] : 0);
    }
    else $items['thisMonth'] = 0;

    echo json_encode($items, JSON_PRETTY_PRINT);
    // print_r($res['thisMonth']);
}
else if($command == "inToday") {
    $curTime = strval(date("h:m:s", time()));

    $querry = "SELECT `inTime`, `outTime` FROM `attendance` WHERE `employeeId` = $id AND DAY(`date`) = DAY(CURDATE()) AND MONTH(`date`) = MONTH(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE()) ORDER BY `inTime` AND `outTime` = '00:00:00' DESC LIMIT 1";
    $stmt = $connect->prepare($querry);
    $stmt->execute();
    $num = $stmt->rowCount();
    if($num == 0) $return =  "00:00";
    else {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $return = $row['outTime'];
    }
        echo json_encode($return, JSON_PRETTY_PRINT);
}


?>