<?php
      include '../partial/_helper.php';
?>

<div class="col-12 row vh-20 admin-nav w-100 m-0 div-navbar">
    <div class="left  col-md-6 col-12">
        <a class="navbar-brand" href="home.php"><span class="text-succes fst-italic fw-bold text-success border rounded-pill px-2 py-1 bg-light">letDiscuss</span></a>
    </div>
    <div class="right col-md-6 col-12">
        <div class="user-details d-flex px-5">
            <div class="admin-username-label">
            <span class="text-succes fst-italic fw-bold text-light"><?php echo $_SESSION['loggedin_username'] ?></span>  
            </div>
            <div class="user-profile rounded-circle bg-primary">
                <img src="../public/images/tradimg.jpg" class="rounded-circle" alt="" width="45" height="45">
            </div>
            <div class="user-profile text-white admin-username-label ms-2">
                <a href="adminLogout.php" class="fw-bold btn btn-outline-info text-light" style="text-decoration:none;">Logout</a>
            </div>
        </div>
    </div>
</div>