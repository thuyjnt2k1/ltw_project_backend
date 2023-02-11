<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/personal_info.php');

$db = new db();
$connect = $db->connect();

$personal_info = new Personal_info($connect);
$read = $personal_info->read();

$num = $read->rowCount();
if ($num > 0) {
    $personal_info_list = [];
    $personal_info_list['data'] = [];

    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $personal_info_item = array(
            'employeeId' => $employeeId,
            'name' => $name,
            'gender' => $gender,
            'dateOfBirth' => $dateOfBirth,
            'birthplace' => $birthplace,
            'maritalStatus' => $maritalStatus,
            'email' => $email,
            'phone' => $phone,
            'emergencyPhone' => $emergencyPhone,
            'address' => $address,
            'imageUrl' => $imageUrl,

        );
        array_push($personal_info_list['data'], $personal_info_item);
    }
    echo json_encode($personal_info_list, JSON_PRETTY_PRINT);
}
?>