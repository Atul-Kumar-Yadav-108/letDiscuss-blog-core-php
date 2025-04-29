<?php
    session_start();
?>
<?php include 'partials/_header.php' ?>
<?php include 'partials/_navBar.php' ?>
<?php include 'partials/_leftNav.php' ?>

<?php
    if($_SESSION['loggedin']== true){
    include '../partial/_dbconnection.php';

    $resultUser =mysqli_query($conn, 'SELECT * FROM users');
    $resultUserCount = mysqli_num_rows($resultUser);
    $resultUserActive =mysqli_query($conn, 'SELECT * FROM users WHERE is_deleted = 0');
    $resultUserActiveCount = mysqli_num_rows($resultUserActive);
    $resultCateogy =mysqli_query($conn, 'SELECT * FROM categories WHERE is_deleted = 0');
    $resultCateogyCount = mysqli_num_rows($resultCateogy);
    $resultCateogyRequest =mysqli_query($conn, 'SELECT * FROM category_requests WHERE req_status = 0');
    $resultCateogyRequestCount = mysqli_num_rows($resultCateogyRequest);
    }else{
        header('location: index.php');
    }
?>

<div class="admin-home-div col-12 container">
    <h2 class="py-3 px-2 my-3">Welcome ,<?php echo $_SESSION['loggedin_username'] ?></h2>
    <div class="cars-sapce row col-12">
        <div class="total-users-count col-md-3 col-12">
            <div class="card d-flex flex-row align-items-center rounded shadow">
                <div class="image">
                    <img src="../public/images/tradimg.jpg" width="100" height="100" alt="">
                </div>
                <div class="info-about">Total users : <?php echo $resultUserCount ?></div>
            </div>
        </div>
        <div class="total-categories-count col-md-3 col-12">
            <div class="card d-flex flex-row align-items-center rounded shadow">
                <div class="image">
                    <img src="../public/images/tradimg.jpg" width="100" height="100" alt="">
                </div>
                <div class="info-about">Total Active users : <?php echo $resultUserActiveCount ?></div>
            </div>
        </div>
        <div class="total-categories-count col-md-3 col-12">
            <div class="card d-flex flex-row align-items-center rounded shadow">
                <div class="image">
                    <img src="../public/images/tradimg.jpg" width="100" height="100" alt="">
                </div>
                <div class="info-about">Total categories : <?php echo $resultCateogyCount ?></div>
            </div>
        </div>
        <div class="total-categories-count col-md-3 col-12">
            <div class="card d-flex flex-row align-items-center rounded shadow">
                <div class="image">
                    <img src="../public/images/tradimg.jpg" width="100" height="100" alt="">
                </div>
                <div class="info-about">Total Categories request : <?php echo $resultCateogyRequestCount?></div>
            </div>
        </div>
    </div>
</div>






<?php include 'partials/_footer.php' ?>