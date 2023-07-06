<?php
  include_once('db.php');
  class Users extends DatabaseConnection {
    public $status;
    public $message;
    public $error = false;
    public function getStatus () {
      return $this->$status;
    }
    public function getMessage () {
      return $this->message;
    }
    public function checkForError () {
        return $this->error;
    }
}
class UserActions extends Users {
    public function login($email,$password) {
        $result=mysqli_query($this->db,"select * from users where email='$email' and password='$password'");
        $count = mysqli_num_rows($result);
        if ($count <= 0) {
            $this->$status = 400;
            $this->error = true;
            $this->message = 'Invalid Email and Password';
        } else {
            $this->$status = 200;
            $this->error = false;
            $this->message = 'Logged in successfully'; 
        }
	} 
    public function signup($name,$email,$password) {
        $sql = "insert into users (username,email,password) values('$name','$email','$password')";
        $checkCondition = $this->registeredAlready($email);
        $count = mysqli_num_rows($checkCondition);
        if ($count > 0) {
          $this->$status = 409;
          $this->error = true;
          $this->message = 'Email already exits';
        } else {
            $result = mysqli_query($this->db, $sql);
            if ($result) {
              $this->$status = 200;
              $this->message = 'Registered Succesfully';
            } else {
              $this->$status = 400;
              $this->error = true;
              $this->message = 'Something went wrong try again !';
            }
        }
    }
    public function registeredAlready ($email) {
        $result=mysqli_query($this->db,"select * from users where email='$email'");
        return $result;
    }
}
?>