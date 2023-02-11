<?php
class Company_dayoff
{
    private $conn;
    public $date  ;
    public $occasion;


    // connect db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $querry = "SELECT * FROM company_dayoff";
        $stmt = $this->conn->prepare($querry);
        $stmt->execute();
        return $stmt;
    }

    public function show()
    {
        $querry = "SELECT * FROM company_dayoff WHERE date=? LIMIT 1 ";
        $stmt = $this->conn->prepare($querry);
        $stmt->bindParam(1, $this->date);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->date = $row['date'];
        $this->occasion = $row['occasion'];

   
    }

    public function create()
    {
        $querry = "INSERT INTO `company_dayoff` SET  `date`=:date, `occasion`=:occasion";

        $stmt = $this->conn->prepare($querry);

        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->occasion = htmlspecialchars(strip_tags($this->occasion));

        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':occasion', $this->occasion);
    
        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }

    public function update()
    {
        $querry = "UPDATE `company_dayoff` SET `date`=:date, `occasion`=:occasion WHERE `date`=:date";

        $stmt = $this->conn->prepare($querry);

        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->occasion = htmlspecialchars(strip_tags($this->occasion));

        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':occasion', $this->occasion);

        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $querry = "DELETE FROM `company_dayoff` WHERE date=?";

        $stmt = $this->conn->prepare($querry);

        $stmt->bindParam(1, $this->date);


        if ($stmt->execute()) {
            return true;
        }
        printf("ERROR %s\n", $stmt->error);
        return false;
    }
}
?>