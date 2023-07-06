<?php
interface SanitoryCheck {
    public function isUserNameValid($name);
    public function isEmailValid($email);
    public function isPasswordValid($password);
}

class SanitoryCheckConditions implements SanitoryCheck {
    public function isUserNameValid($name) {
        return !($name != '' && strlen($name) > 5);
    }

    public function isPasswordValid($password) {
        return !($password !='' && strlen($password) > 8);
    }

    public function isEmailValid($email) {
        return !($email !='' && strlen($email) > 5);
    }
}
?>
