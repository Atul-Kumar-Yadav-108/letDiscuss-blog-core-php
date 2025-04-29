<?php
  session_start();
  include '_dbconnection.php';
  include '_helper.php';

  // print_r($_SERVER['REQUEST_URI']);
?>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><span class="text-succes fst-italic fw-bold text-success border rounded-pill px-2 py-1 bg-light">letDiscuss</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'],'index.php') ? 'active' : ''?>" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'],'about.php') ? 'active' : ''?>" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo strpos($_SERVER['REQUEST_URI'],'forum.php') || strpos($_SERVER['REQUEST_URI'],'forumlist.php') ? 'active' : ''?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                            $cat_sql = "SELECT * FROM `categories` WHERE `is_deleted` = 0 LIMIT 10";
                            $cat_result = mysqli_query($conn, $cat_sql);
                            $cat_count = mysqli_num_rows($cat_result);
                            if($cat_count > 0){
                              while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                echo '<li><a class="dropdown-item" href="forumlist.php?catid='.$cat_row['category_id'].'">'.$cat_row['category_name'].'</a></li>';
                              }
                            }
            ?>
            <!-- <li><a class="dropdown-item" href="#">Python</a></li>
            <li><a class="dropdown-item" href="#">Laravel</a></li> -->
            <!-- <li><hr class="dropdown-divider"></li> -->
            <!-- <li><a class="dropdown-item" href="#">Javascript</a></li> -->
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'],'contactus.php') ? 'active' : ''?>" href="contactus.php" tabindex="-1">Contact Us</a>
        </li>
        <li class="nav-item">
          <a href="request-to-add-category.php" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'],'request-to-add-category.php') ? 'active' : ''?>">Request to create category</a>
        </li>
      </ul>
      <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" name="queries" id="queries" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success me-2" type="submit">Search</button>
        <?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
                echo '<div class="buttons-signip-login d-flex gap-2 me-5">
                        <div class="flex-shrink-0 dropdown me-5">
                            <a class="nav-link" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../letDiscuss/public/images/tradimg.jpg" width="40px" alt="..." class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-center p-0 rounded" aria-labelledby="profileDropdown">
                                <li>Welcome, '.$_SESSION['loggedin_username'].'<li>
                                <li class="mt-2 changepass"><a href="" data-bs-toggle="modal" data-bs-target="#changePasswordModal" class="btn">Change Password</a><li>
                                <li class=" bg-secondary text-white"><a href="../letDiscuss/controller/logout.php" class="btn text-white">Logut</a><li>
                            </ul>
                        </div>
                    </div>';
          }else{
            echo '<div class="buttons-signip-login d-flex gap-2">
                  <a href="" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                  <a href="" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Singup</a>
                </div>';
          }
        ?>
      </form>
    </div>
  </div>
</nav>
</header>

<?php
    include '_login.php';
    include '_signup.php';
    include '_changePassword.php';

    // signup and login messages

    if(isset($_GET['emailExistMessage']) && $_GET['emailExistMessage'] == 'true'){
      echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
      <strong>Email Exists!</strong>Email Already exists.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if(isset($_GET['signupmessage']) && $_GET['signupmessage'] == 'true'){
      echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
                    <strong>Success !</strong> Account created Successfully;
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }elseif(isset($_GET['signupmessage']) && $_GET['signupmessage'] == 'false'){
      echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
                    <strong>Error !</strong> Account not created ,Please try again;
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }

    if(isset($_GET['loginMessage']) && $_GET['loginStatus'] == 'true'){
      echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
      <strong>Success !</strong> '.$_GET['loginMessage'].$_SESSION['loggedin_username'].'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }elseif(isset($_GET['loginMessage']) && $_GET['loginStatus'] == 'false'){
      echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
      <strong>Error !</strong> '.$_GET['loginMessage'].'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>

<!-- change password message  -->
<?php
 if(isset($_GET['passchangemsg']) && $_GET['changePassStatus'] == 'true'){
  echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
  <strong>Success !</strong> '.$_GET['passchangemsg'].'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}elseif(isset($_GET['passchangemsg']) && $_GET['changePassStatus'] == 'false'){
  echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
  <strong>Error !</strong> '.$_GET['passchangemsg'].'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>
<!-- alert for login to use this feature -->


