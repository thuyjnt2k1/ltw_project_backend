<?php
class Account
{
    private $conn;
    public $username  ;
    public $password;
    public $employeeId ;
    public $userType;
    public $accStatus ;


    // connect db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $querry = "SELECT * FROM account";
        $stmt = $this->conn->prepare($querry);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $querry = "SELECT * FROM account WHERE employeeId=? LIMIT 1 ";
        $stmt = $this->conn->prepare($querry);
        $stmt->bindParam(1, $this->employeeId);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->employeeId = $row['employeeId'];
        $this->userType = $row['userType'];
        $this->accStatus = $row['accStatus'];
   
    }

    public function create()
    {
        $querry = "INSERT INTO `account` SET  `username`=:username, `password`=:password, `employeeId`=:employeeId, `userType`=:userType, `accStatus`=:accStatus";

        $stmt = $this->conn->prepare($querry);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
        $this->userType = htmlspecialchars(strip_tags($this->userType));
        $this->accStatus = htmlspecialchars(strip_tags($this->accStatus));
 

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':employeeId', $this->employeeId);
        $stmt->bindParam(':userType', $this->userType);
        $stmt->bindParam(':accStatus', $this->accStatus);

        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }

    public function update()
    {
        $querry = "UPDATE `account` SET `password`=:password, `employeeId`=:employeeId, `userType`=:userType, `accStatus`=:accStatus WHERE `employeeId`=:employeeId";

        $stmt = $this->conn->prepare($querry);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
        $this->userType = htmlspecialchars(strip_tags($this->userType));
        $this->accStatus = htmlspecialchars(strip_tags($this->accStatus));
 

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':employeeId', $this->employeeId);
        $stmt->bindParam(':userType', $this->userType);
        $stmt->bindParam(':accStatus', $this->accStatus);

        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $querry = "DELETE FROM `account` WHERE employeeId=?";

        $stmt = $this->conn->prepare($querry);

        $stmt->bindParam(1, $this->employeeId);


        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }
}
?>