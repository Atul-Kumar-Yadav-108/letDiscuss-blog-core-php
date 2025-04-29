<?php
    include '../partial/_dbconnection.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['singup-submit'])){
            // echo "sign up buddy";
           $signupemail = $_POST['signupemail'];
           $signupusername = $_POST['signupusername'];
           $singuppassword = $_POST['singuppassword'];
           $csinguppassword = $_POST['csinguppassword'];

           $checkEmailExist = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_email` = '$signupemail'");
           if(mysqli_num_rows($checkEmailExist) > 0){
                header("location: ../index.php?emailExistMessage=true");
           }else{
                $hashPass = password_hash($singuppassword,PASSWORD_DEFAULT);
                $sqlSignup = "INSERT INTO `users` (`user_email`,`username`,`password`) VALUES('$signupemail','$signupusername','$hashPass')";
                $resultSignup = mysqli_query($conn, $sqlSignup);

                if($resultSignup){
                    header("location: ../index.php?signupmessage=true");
                }else{
                    header("location: ../index.php?signupmessage=false");
                }

           }
        }


        if(isset($_POST['login-submit'])){
            // echo "login buddy";
            $loginMessage;
            $loginemail = $_POST['loginemail'];
            $loginpassword = $_POST['loginpassword'];
            $existAccount = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_email` = '$loginemail'");
            $rowCount = mysqli_num_rows($existAccount);
            $resRow = mysqli_fetch_row($existAccount);
            $fbpassword = $resRow[3];
            $usernamedb = $resRow[2];
            $emaildb = $resRow[1];
            $iddb = $resRow[0];
            if($rowCount < 1){
                $loginMessage = 'Account does not exists';
                header("location: ../index.php?loginMessage=$loginMessage&loginStatus=false");
            }else{
                $loginHash = password_hash($loginpassword, PASSWORD_DEFAULT);
                if(!password_verify($loginpassword,$fbpassword)){
                    $loginMessage = 'Password is not correct';
                    header("location: ../index.php?loginMessage=$loginMessage&loginStatus=false");
                }else{
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['loggedin_email'] = $emaildb;
                    $_SESSION['loggedin_id'] = $iddb;
                    $_SESSION['loggedin_username'] = $usernamedb;
                    $loginMessage = 'Welcome ,';
                    header("location: ../index.php?loginMessage=$loginMessage&loginStatus=true");
                }
            }
            
        }

        if(isset($_POST['change-pass-submit'])){
            session_start();
            $changePasswordMessage = '';
            $password = $_POST['changePassword'];
            $userid = $_SESSION['loggedin_id'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $updateResult = mysqli_query($conn, "UPDATE `users` SET password = '$hashedPassword' WHERE id= '$userid' ");
            if($updateResult){
                $changePasswordMessage = "You password has been changed successfully.";
                header("location: ../index.php?passchangemsg=$changePasswordMessage&changePassStatus=true");
            }else{
                $changePasswordMessage = "Something went wrong. Please try again.";
                header("location: ../index.php?passchangemsg=$changePasswordMessage&changePassStatus=false");
            }
            // print_r($_POST['changePassword']);
            // echo "<pre>";
            // print_r($_SESSION['loggedin_id']);
            // die;
        }
    }
?>