<?php
class staff_info{
    private $conn;
    public $employeeId;
    public $jobTitle;
    public $jobDescription;
    public $department;
    public $skill;
    public $hiredDate;
    public $office;
    public $education;
    public $language;
    public $perfomanceReview;

    // connect db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $querry = "SELECT * FROM staff_info";
        $stmt = $this->conn->prepare($querry);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $querry = "SELECT * FROM staff_info WHERE employeeId=? LIMIT 1 ";
        $stmt = $this->conn->prepare($querry);
        $stmt->bindParam(1, $this->employeeId);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->employeeId = $row['employeeId'];
        $this->jobTitle = $row['jobTitle'];
        $this->jobDescription = $row['jobDescription'];
        $this->department = $row['department'];
        $this->skill = $row['skill'];
        $this->hiredDate = $row['hiredDate'];
        $this->office = $row['office'];
        $this->education = $row['education'];
        $this->language = $row['language'];
        $this->perfomanceReview = $row['perfomanceReview'];
    }
    public function create()
    {
        $querry = "INSERT INTO `staff_info` SET `employeeId`=:employeeId, `jobTitle`=:jobTitle, `jobDescription`=:jobDescription, `department`=:department, `skill`=:skill, `hiredDate`=:hiredDate,  `office`=:office, `education`=:education, `language`=:language, `perfomanceReview`=:perfomanceReview" ;

        $stmt = $this->conn->prepare($querry);

        $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
        $this->jobTitle = htmlspecialchars(strip_tags($this->jobTitle));
        $this->jobDescription = htmlspecialchars(strip_tags($this->jobDescription));
        $this->department = htmlspecialchars(strip_tags($this->department));
        $this->skill = htmlspecialchars(strip_tags($this->skill));
        $this->hiredDate = htmlspecialchars(strip_tags($this->hiredDate));
        $this->office = htmlspecialchars(strip_tags($this->office));
        $this->education = htmlspecialchars(strip_tags($this->education));
        $this->language = htmlspecialchars(strip_tags($this->language));
        $this->perfomanceReview = htmlspecialchars(strip_tags($this->perfomanceReview));

        $stmt->bindParam(':employeeId', $this->employeeId);
        $stmt->bindParam(':jobTitle', $this->jobTitle);
        $stmt->bindParam(':jobDescription', $this->jobDescription);
        $stmt->bindParam(':department', $this->department);
        $stmt->bindParam(':skill', $this->skill);
        $stmt->bindParam(':hiredDate', $this->hiredDate);
        $stmt->bindParam(':office', $this->office);
        $stmt->bindParam(':education', $this->education);
        $stmt->bindParam(':language', $this->language);
        $stmt->bindParam(':perfomanceReview', $this->perfomanceReview);

        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }
    public function update()
    {
        $querry = "UPDATE `staff_info` SET `jobTitle`=:jobTitle, `jobDescription`=:jobDescription, `department`=:department, `skill`=:skill, `hiredDate`=:hiredDate, `office`=:office, `education`=:education, `language`=:language, `perfomanceReview`=:perfomanceReview WHERE employeeId=:employeeId";

        $stmt = $this->conn->prepare($querry);
        $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
        $this->jobTitle = htmlspecialchars(strip_tags($this->jobTitle));
        $this->jobDescription = htmlspecialchars(strip_tags($this->jobDescription));
        $this->department = htmlspecialchars(strip_tags($this->department));
        $this->skill = htmlspecialchars(strip_tags($this->skill));
        $this->hiredDate = htmlspecialchars(strip_tags($this->hiredDate));
        $this->terminationDate = htmlspecialchars(strip_tags($this->terminationDate));
        $this->office = htmlspecialchars(strip_tags($this->office));
        $this->education = htmlspecialchars(strip_tags($this->education));
        $this->language = htmlspecialchars(strip_tags($this->language));
        $this->perfomanceReview = htmlspecialchars(strip_tags($this->perfomanceReview));

        $stmt->bindParam(':employeeId', $this->employeeId);
        $stmt->bindParam(':jobTitle', $this->jobTitle);
        $stmt->bindParam(':jobDescription', $this->jobDescription);
        $stmt->bindParam(':department', $this->department);
        $stmt->bindParam(':skill', $this->skill);
        $stmt->bindParam(':hiredDate', $this->hiredDate);
        $stmt->bindParam(':terminationDate', $this->terminationDate);
        $stmt->bindParam(':office', $this->office);
        $stmt->bindParam(':education', $this->education);
        $stmt->bindParam(':language', $this->language);
        $stmt->bindParam(':perfomanceReview', $this->perfomanceReview);
        

        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }
    public function delete()
    {
        $querry = "DELETE FROM `staff_info` WHERE employeeId=?";

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