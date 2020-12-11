<?php 
require 'function.php';
if(isset($_POST["register"])) {
    if(register($_POST) > 0) {
        echo "<script>
                alert('register success');
              </script>";
    } else {
        // echo "SALAAH";
        echo mysqli_error($connection);
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="./style/register.css">
    <title>School App</title>
</head>
<body>
    <!-- REGISTRATION FORM -->
    <div class="d-flex flex-column align-items-center justify-content-center" style="height:100vh">
        <div class="logo">register</div>
            <!-- Main Form -->
            <div class="login-form-1">
                <form method="post" id="register-form" class="text-left">
                    <div class="login-form-main-message"></div>
                    <div class="main-login-form">
                        <div class="login-group">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email address</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            </div>
                            <div class="form-group">
                                <label for="password2" class="sr-only">Password Confirm</label>
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="confirm password">
                            </div>
                            
                            <!-- <div class="form-group">
                                <label for="reg_email" class="sr-only">Email</label>
                                <input type="text" class="form-control" id="reg_email" name="reg_email" placeholder="email">
                            </div>
                            <div class="form-group">
                                <label for="reg_fullname" class="sr-only">Full Name</label>
                                <input type="text" class="form-control" id="reg_fullname" name="reg_fullname" placeholder="full name">
                            </div>
                            
                            <div class="form-group login-group-checkbox">
                                <input type="radio" class="" name="reg_gender" id="male" placeholder="username">
                                <label for="male">male</label>
                                
                                <input type="radio" class="" name="reg_gender" id="female" placeholder="username">
                                <label for="female">female</label>
                            </div> -->
                            
                            <!-- <div class="form-group login-group-checkbox">
                                <input type="checkbox" class="" id="reg_agree" name="reg_agree">
                                <label for="reg_agree">i agree with <a href="#">terms</a></label>
                            </div> -->
                        </div>
                        <button type="submit" class="login-button" name="register"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <div class="etc-login-form">
                        <p>already have an account? <a href="login.php">login here</a></p>
                    </div>
                </form>
            </div>
            <!-- end:Main Form -->
    </div>
    <script src="./scripts/register.js"></script>
</body>
</html>