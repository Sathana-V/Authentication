<?php
 class DatabaseConnection {
    public $db;
    function __construct() {
        $con = mysqli_connect('localhost','root','','website');
        $this->db=$con;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    } 
}
?>