<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


include_once('../../config/db.php');
include_once('../../model/account.php');

$db = new db();
$connect = $db->connect();

$account = new Account($connect);

$data = json_decode(file_get_contents("php://input"));

$account->username = $data->username;
$account->password = $data->password;

$run = $connect->prepare("SELECT * FROM `account` ");
$run->execute();
$return = new stdClass;

$num = $run->rowCount();
if ($num > 0) {
    $return_list = [];
    $return_list['data'] = [];

    while ($return = $run->fetch(PDO::FETCH_ASSOC)) {
        extract($return);
        if ($account->username == $username) {
            if($accStatus == 0){
                $result = array(
                    'username' => $username,
                    'response' => '400',
                    'message' => 'Account has been locked!'
                );
                echo json_encode($result, JSON_PRETTY_PRINT);
                die();
            }
            else if($account->password == $password){
                $result = array(
                    'username' => $username,
                    'employeeId' => $employeeId,
                    'userType' => $userType == 0 ? 'user' : 'admin',
                    'response' => '200',
                    'message' => 'Login successfully!!!'
                );
                echo json_encode($result, JSON_PRETTY_PRINT);
                die();
            }
            else{
                $result = array(
                    'response' => '401',
                    'message' => 'Wrong password!!!'
                );
                echo json_encode($result, JSON_PRETTY_PRINT);
                die();
            }
        }
    }
    $result = array(
        'response' => '40',
        'message' => 'Account not exsisted!!!'
    );
    echo json_encode($result, JSON_PRETTY_PRINT);
    die();
}


?>