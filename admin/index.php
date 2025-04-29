<?php
    include ('partials/_header.php');
    include ('../partial/_dbconnection.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        # code...
        // print_r($_POST);
        $email = $_POST['admin_email'];
        $pass = $_POST['admin_pass'];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$email'");
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            // die;
            $hashpass = $row['password'];
            if(password_verify($pass, $hashpass)){
                // header('location: home.php');
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['loggedin_email'] = $row['user_email'];
                $_SESSION['loggedin_id'] = $row['id'];
                $_SESSION['loggedin_username'] = $row['username'];
                $loginMessage = 'Welcome ,';
                header("location: home.php?loginMessage=$loginMessage&loginStatus=true");
            }else{
                echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
                <strong>Error !</strong> Wrong password.Please enter correct password
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

            }
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
            <strong>Error !</strong> No record exists.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
?>







    <div class="w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="container col-lg-4 col-md-6 col-12 bg-light-purple-whitish py-4 px-3 rounded shadow">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="text-center mb-3">
                            <label for="" class="fs-2 fw-bold">Admin Login</label>
                        </div>
                        <div class="mb-3">
                            <label for="admin_email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="admin_email" name="admin_email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="admin_pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="admin_pass" name="admin_pass">
                        </div>
                        <!-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
        </div>
    </div>
<?php
    include ('partials/_footer.php')
?>