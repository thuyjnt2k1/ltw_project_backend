<?php
class Personal_info
{
    private $conn;
    public $employeeId;
    public $name;
    public $gender;
    public $dateOfBirth;
    public $birthplace;
    public $maritalStatus;
    public $email;
    public $phone;
    public $emergencyPhone;
    public $address;
    public $imageUrl;



    // connect db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $querry = "SELECT * FROM personal_info";
        $stmt = $this->conn->prepare($querry);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $querry = "SELECT * FROM personal_info WHERE employeeId=? LIMIT 1 ";
        $stmt = $this->conn->prepare($querry);
        $stmt->bindParam(1, $this->employeeId);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->employeeId = $row['employeeId'];
        $this->name = $row['name'];
        $this->gender = $row['gender'];
        $this->dateOfBirth = $row['dateOfBirth'];
        $this->birthplace = $row['birthplace'];
        $this->maritalStatus = $row['maritalStatus'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->emergencyPhone = $row['emergencyPhone'];
        $this->address = $row['address'];
        $this->imageUrl = $row['imageUrl'];

    }

    public function create()
    {
        $querry = "INSERT INTO `personal_info` SET  `employeeId`=:employeeId, `name`=:name, `gender`=:gender, `dateOfBirth`=:dateOfBirth, `birthplace`=:birthplace, `maritalStatus`=:maritalStatus, `email`=:email, `phone`=:phone, `emergencyPhone`=:emergencyPhone, `address`=:address, `imageUrl`=:imageUrl";
        try {
            $stmt = $this->conn->prepare($querry);

            $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->gender = htmlspecialchars(strip_tags($this->gender));
            $this->dateOfBirth = htmlspecialchars(strip_tags($this->dateOfBirth));
            $this->birthplace = htmlspecialchars(strip_tags($this->birthplace));
            $this->maritalStatus = htmlspecialchars(strip_tags($this->maritalStatus));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->emergencyPhone = htmlspecialchars(strip_tags($this->emergencyPhone));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->imageUrl = htmlspecialchars(strip_tags($this->imageUrl));


            $stmt->bindParam(':employeeId', $this->employeeId);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':gender', $this->gender);
            $stmt->bindParam(':dateOfBirth', $this->dateOfBirth);
            $stmt->bindParam(':birthplace', $this->birthplace);
            $stmt->bindParam(':maritalStatus', $this->maritalStatus);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':emergencyPhone', $this->emergencyPhone);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':imageUrl', $this->imageUrl);

            if ($stmt->execute()) {
                return true;
            }

        } catch (\PDOException $e) {
            return false;
        }
    }

    public function update()
    {
        $querry = "UPDATE `personal_info` SET `name`=:name, `gender`=:gender, `dateOfBirth`=:dateOfBirth, `birthplace`=:birthplace, `maritalStatus`=:maritalStatus, `email`=:email, `phone`=:phone, `emergencyPhone`=:emergencyPhone, `address`=:address, `imageUrl`=:imageUrl WHERE `employeeId`=:employeeId";

        $stmt = $this->conn->prepare($querry);

        $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->dateOfBirth = htmlspecialchars(strip_tags($this->dateOfBirth));
        $this->birthplace = htmlspecialchars(strip_tags($this->birthplace));
        $this->maritalStatus = htmlspecialchars(strip_tags($this->maritalStatus));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->emergencyPhone = htmlspecialchars(strip_tags($this->emergencyPhone));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->imageUrl = htmlspecialchars(strip_tags($this->imageUrl));


        $stmt->bindParam(':employeeId', $this->employeeId);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':dateOfBirth', $this->dateOfBirth);
        $stmt->bindParam(':birthplace', $this->birthplace);
        $stmt->bindParam(':maritalStatus', $this->maritalStatus);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':emergencyPhone', $this->emergencyPhone);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':imageUrl', $this->imageUrl);

        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $querry = "DELETE FROM `personal_info` WHERE employeeId=?";

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