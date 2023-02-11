<?php
class Attendance
{
    private $conn;
    public $attendanceId;
    public $type;
    public $outEarlyReason;
    public $date;
    public $inTime;
    public $outTime;
    public $employeeId;


    // connect db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $querry = "SELECT * FROM attendance";
        $stmt = $this->conn->prepare($querry);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $querry = "SELECT * FROM attendance WHERE attendanceId=? LIMIT 1 ";
        $stmt = $this->conn->prepare($querry);
        $stmt->bindParam(1, $this->attendanceId);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->attendanceId = $row['attendanceId'];
        $this->type = $row['type'];
        $this->outEarlyReason = $row['outEarlyReason'];
        $this->date = $row['date'];
        $this->inTime = $row['inTime'];
        $this->outTime = $row['outTime'];
        $this->employeeId = $row['employeeId'];
    }

    public function create()
    {
        $querry = "INSERT INTO `attendance` SET `attendanceId`=:attendanceId, `type`=:type, `outEarlyReason`=:outEarlyReason, `date`=:date, `inTime`=:inTime, `outTime`=:outTime , `employeeId`=:employeeId";

        $stmt = $this->conn->prepare($querry);

        $this->attendanceId= htmlspecialchars(strip_tags($this->attendanceId));
        $this->type= htmlspecialchars(strip_tags($this->type));
        $this->outEarlyReason= htmlspecialchars(strip_tags($this->outEarlyReason));
        $this->date= htmlspecialchars(strip_tags($this->date));
        $this->inTime= htmlspecialchars(strip_tags($this->inTime));
        $this->outTime= htmlspecialchars(strip_tags($this->outTime));
        $this->employeeId= htmlspecialchars(strip_tags($this->employeeId));

        $stmt->bindParam(':attendanceId', $this->attendanceId);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':outEarlyReason', $this->outEarlyReason);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':inTime', $this->inTime);
        $stmt->bindParam(':outTime', $this->outTime);
        $stmt->bindParam(':employeeId', $this->employeeId);

        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }

    public function update()
    {
        $querry = "UPDATE `attendance`  SET `type`=:type, `outEarlyReason`=:outEarlyReason, `date`=:date, `inTime`=:inTime, `outTime`=:outTime , `employeeId`=:employeeId WHERE attendanceId=:attendanceId";

        $stmt = $this->conn->prepare($querry);

        $this->attendanceId= htmlspecialchars(strip_tags($this->attendanceId));
        $this->type= htmlspecialchars(strip_tags($this->type));
        $this->outEarlyReason= htmlspecialchars(strip_tags($this->outEarlyReason));
        $this->date= htmlspecialchars(strip_tags($this->date));
        $this->inTime= htmlspecialchars(strip_tags($this->inTime));
        $this->outTime= htmlspecialchars(strip_tags($this->outTime));
        $this->employeeId= htmlspecialchars(strip_tags($this->employeeId));

        $stmt->bindParam(':attendanceId', $this->attendanceId);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':outEarlyReason', $this->outEarlyReason);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':inTime', $this->inTime);
        $stmt->bindParam(':outTime', $this->outTime);
        $stmt->bindParam(':employeeId', $this->employeeId);

        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $querry = "DELETE FROM `attendance` WHERE attendanceId=?";

        $stmt = $this->conn->prepare($querry);

        $stmt->bindParam(1, $this->attendanceId);


        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }
}
?>