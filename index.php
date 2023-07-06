<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<script>
    function moveToPage(params) {
      debugger
      location.href = params
    }
</script>
<?php 
    include_once('users.php');
    include_once('rules.php');
    $users = new UserActions();
    $sanitoryCheck = new SanitoryCheckConditions();
    $error = true;
    $message = '';
    //error
    $emailError = false;
    if (isset($_POST['submit'])) {
        $email=$_POST['email'];
        $password=$_POST['password'];
        $emailError = $sanitoryCheck->isEmailValid($email);
        if(!$emailError) {
            $users->login($email,$password);
            $message =  $users->getMessage();
            $error = $users->checkForError();
            $email = '';
            if(!$error) {
                echo 'success';
                echo '<script>moveToPage("success.html")</script>';
            }
        }
    }
?>
<body>
    <div class="login-container">
        <div class="card">
            <div class="login-content">
            <div class="welcome-content">
                <h1>Welcome to xyz</h1>
                <h3>Log In</h3>
                
            </div>
             
            <form action="" method="POST">
                <?php
                    if ($error) {
                        echo '<div class="error-message message">'.$message.'</div>';
                    }
                ?>
              <?php
                  echo '<input type="email" placeholder="Email" name="email" value="'.($email != '' ? $email : '').'"/>';
                ?>
                <?php if ($emailError) { echo '<div class="error-message">Not a valid email</div>'; }?>
                <input type="password" placeholder="Password" name="password"/>
                <br>
                <button type="submit" name="submit">Sign Up</button>
                <p>Don't have account ?</p>
            </form>
                <button onclick="moveToPage('signUp.php')">Create Account</button>
            </div>
            <div class="login-design">
              <img src="./login.jpg" alt="" srcset="">
            </div>
        </div>  
    </div>
</body>
</html>