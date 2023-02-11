<?php
class Furlough
{
    private $conn;
    public $furloughId ;
    public $requestDate;
    public $leaveType;
    public $reason;
    public $leaveFrom ;
    public $leaveTo ;
    public $approvalStatus;
    public $employeeId ;


    // connect db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $querry = "SELECT * FROM furlough";
        $stmt = $this->conn->prepare($querry);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $querry = "SELECT * FROM furlough WHERE furloughId=? LIMIT 1 ";
        $stmt = $this->conn->prepare($querry);
        $stmt->bindParam(1, $this->furloughId);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->furloughId = $row['furloughId'];
        $this->requestDate = $row['requestDate'];
        $this->leaveType = $row['leaveType'];
        $this->reason = $row['reason'];
        $this->leaveFrom = $row['leaveFrom'];
        $this->leaveTo = $row['leaveTo'];
        $this->approvalStatus = $row['approvalStatus'];
        $this->employeeId = $row['employeeId'];
    


    }

    public function create()
    {
        $querry = "INSERT INTO `furlough` SET  `furloughId`=:furloughId, `requestDate`=:requestDate, `leaveType`=:leaveType, `reason`=:reason, `leaveFrom`=:leaveFrom, `leaveTo`=:leaveTo, `approvalStatus`=:approvalStatus, `employeeId`=:employeeId";

        $stmt = $this->conn->prepare($querry);

        $this->furloughId = htmlspecialchars(strip_tags($this->furloughId));
        $this->requestDate = htmlspecialchars(strip_tags($this->requestDate));
        $this->leaveType = htmlspecialchars(strip_tags($this->leaveType));
        $this->reason = htmlspecialchars(strip_tags($this->reason));
        $this->leaveFrom = htmlspecialchars(strip_tags($this->leaveFrom));
        $this->leaveTo = htmlspecialchars(strip_tags($this->leaveTo));
        $this->approvalStatus = htmlspecialchars(strip_tags($this->approvalStatus));
        $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
 

        $stmt->bindParam(':furloughId', $this->furloughId);
        $stmt->bindParam(':requestDate', $this->requestDate);
        $stmt->bindParam(':leaveType', $this->leaveType);
        $stmt->bindParam(':reason', $this->reason);
        $stmt->bindParam(':leaveFrom', $this->leaveFrom);
        $stmt->bindParam(':leaveTo', $this->leaveTo);
        $stmt->bindParam(':approvalStatus', $this->approvalStatus);
        $stmt->bindParam(':employeeId', $this->employeeId);
  



        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }

    public function update()
    {
        $querry = "UPDATE `furlough` SET `requestDate`=:requestDate, `leaveType`=:leaveType, `reason`=:reason, `leaveFrom`=:leaveFrom, `leaveTo`=:leaveTo, `approvalStatus`=:approvalStatus, `employeeId`=:employeeId WHERE `furloughId`=:furloughId";

        $stmt = $this->conn->prepare($querry);

        $this->furloughId = htmlspecialchars(strip_tags($this->furloughId));
        $this->requestDate = htmlspecialchars(strip_tags($this->requestDate));
        $this->leaveType = htmlspecialchars(strip_tags($this->leaveType));
        $this->reason = htmlspecialchars(strip_tags($this->reason));
        $this->leaveFrom = htmlspecialchars(strip_tags($this->leaveFrom));
        $this->leaveTo = htmlspecialchars(strip_tags($this->leaveTo));
        $this->approvalStatus = htmlspecialchars(strip_tags($this->approvalStatus));
        $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
    

        $stmt->bindParam(':furloughId', $this->furloughId);
        $stmt->bindParam(':requestDate', $this->requestDate);
        $stmt->bindParam(':leaveType', $this->leaveType);
        $stmt->bindParam(':reason', $this->reason);
        $stmt->bindParam(':leaveFrom', $this->leaveFrom);
        $stmt->bindParam(':leaveTo', $this->leaveTo);
        $stmt->bindParam(':approvalStatus', $this->approvalStatus);
        $stmt->bindParam(':employeeId', $this->employeeId);
   



        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $querry = "DELETE FROM `furlough` WHERE furloughId=?";

        $stmt = $this->conn->prepare($querry);

        $stmt->bindParam(1, $this->furloughId);


        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }
}
?>