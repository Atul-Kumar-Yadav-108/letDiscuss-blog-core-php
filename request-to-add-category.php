<section>


<!-- header included -->
<?php include 'partial/_header.php' ?>

<?php
   if(isset($_GET['page']) && $_GET['page'] =='catRequest' && $_GET['categRequestMessage'] == 'true'){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Request for Category has been sent successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
   }elseif(isset($_GET['page']) && $_GET['page'] =='catRequest' && $_GET['categRequestMessage']  == 'false'){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Some Error occur while requesting.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
   }
?>

<div class="container my-5 d-flex flex-column align-items-center">
        <h1 class="text-center">Add Category Request</h1>
        <div class="form-container col-md-6 col-sm-12 my-5 bg-light bg-gradient p-3 text-dark rounded border">
            <!-- when users login model created then send their id -->
        <form class="d-flex flex-column" action="controller/addCategory_Request.php" method="post">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="category_name" placeholder="Enter the categroy name" required>
            </div>
            <div class="mb-3">
                <label for="category_description" class="form-label">Category Description</label>
                <input type="text" class="form-control" id="category_description" name="category_description" aria-describedby="category_description" placeholder="Enter the categroy description" required>
            </div>
            <?php
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
                    echo '<button type="submit" class="btn btn-primary col-md-3 col-sm-9 align-self-center">Submit</button>';
                }else{
                    echo '<button type="button" class="btn btn-primary col-md-3 col-sm-9 align-self-center" data-bs-toggle="popover" title="Warning" data-bs-content="Please login first to send request for adding category">Submit</button>';
                }
                ?>
        </form>
        </div>
</div>


</section>
<!-- footer included -->
<?php include 'partial/_footer.php' ?>