<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/staff_info.php');

$db = new db();
$connect = $db->connect();

$staff_info = new staff_info($connect);
$read = $staff_info->read();

$num = $read->rowCount();
if ($num > 0) {
    $staff_info_list = [];
    $staff_info_list['data'] = [];

    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $staff_info_item = array(
            'employeeId' => $employeeId,
            'jobTitle' => $jobTitle,
            'jobDescription' => $jobDescription,
            'department' => $department,
            'skill' => $skill,
            'hiredDate' => $hiredDate,
            'terminationDate' => $terminationDate,
            'office' => $office,
            'education' => $education,
            'language' => $language,
            'perfomanceReview' => $perfomanceReview,
        );
        array_push($staff_info_list['data'], $staff_info_item);
    }
    echo json_encode($staff_info_list, JSON_PRETTY_PRINT);
}
?>