<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php 
include_once('users.php');
include_once('rules.php');
$users = new UserActions();
$sanitoryCheck = new SanitoryCheckConditions();
$error = true;
$message = '';
//error
$nameError = false;
$emailError = false;
$passwordError = false;
if (isset($_POST['submit'])) {
    $name=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $nameError = $sanitoryCheck->isUserNameValid($name);
    $emailError = $sanitoryCheck->isEmailValid($email);
    $passwordError = $sanitoryCheck->isPasswordValid($password);
    if(!$nameError && !$emailError && !$passwordError) {
        $users->signup($name,$email,$password);
        $message =  $users->getMessage();
        $error = $users->checkForError();
        $name = '';
        $email = '';
        $password = '';
    }
}
?>
    <div class="login-container">
        <div class="card">
            <div class="login-content">
            <div class="welcome-content">
                <h1>Welcome to xyz</h1>
                <h3>Sign Up</h3>
                <p>Enter your personal details and start journey with us</p>
            </div>
              <form action="" method="POST">
                <?php
                    if ($error) {
                        echo '<div class="error-message message">'.$message.'</div>';
                    } else {
                        echo '<div class="success-message message">'.$message.'</div>';
                    }
                ?>
                <?php
                    echo '<input type="text" placeholder="Username" name="username" value="'.($name != '' ? $name : '').'"/>';
                ?>
                <?php if ($nameError) { echo '<div class="error-message">User name must have atleast 5 characters</div>'; }?>
                <?php
                  echo '<input type="email" placeholder="Email" name="email" value="'.($email != '' ? $email : '').'"/>';
                ?>
                <?php if ($emailError) { echo '<div class="error-message">Not a valid email</div>'; }?>
                <?php
                  echo '<input type="password" placeholder="Password" name="password" value="'.($password != '' ? $password : '').'"/>';
                ?>
                
                <?php if ($passwordError) { echo '<div class="error-message">Password should be at least 8 characters.</div>'; }?>
                <br>
                <br>
                <button type="submit" name="submit">Sign Up</button>
              </form>
              <p>Have account ?</p>
              <button onclick="moveToPage('index.php')" class="login-button">Log in</button>
             
            </div>
            <div class="login-design">
              <img src="./login.jpg" alt="" srcset="">
            </div>
            
        </div>  
    </div>
</body>
<script>
    function moveToPage(params) {
      location.href = params
    }
</script>
</html>