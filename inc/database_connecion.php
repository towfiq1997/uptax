<?php
class chamber
{
    public $host = "localhost";
    public $username = "stcsqata_chamber";
    public $password = "chamberchoyon";
    public $db = "stcsqata_chamber";
    public $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);
    }

    public function createletter($ref, $comname, $contact, $memberno, $crno, $content)
    {
        $sql = "INSERT INTO letter (refno,comname,contact,memberno,crno,content) VALUES('$ref','$comname','$contact','$memberno','$crno','$content')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function login($sql)
    {
        session_start();
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            header('location:test.php');
        } else {
            $msg = "<p>Password Or Email Doesn't Match Try Again!</p>";
            return $msg;
        }
    }
}
