<section>
<!-- header included -->
<?php include 'partial/_header.php' ?>

<!-- <h1>Contect us - let discuss</h1> -->
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    // echo "WElcome to contact";
    // print_r($_POST);

    $contact_email = $_POST['contact_email'];
    $contact_name = $_POST['contact_name'];
    $contact_number = $_POST['contact_number'];
    $contact_description = $_POST['contact_description'];

    $sqlContact = "INSERT INTO `contacts` (`contact_email`,`contact_name`,`contact_phone`,`contact_description`) VALUES('$contact_email','$contact_name','$contact_number','$contact_description')";

    $resultContact = mysqli_query($conn, $sqlContact);
    if($resultContact){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>Query has been sent.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Query sent fails!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}


?>




<div class=" col-sm-12 col-md-6  container my-5 border p-3 rounded bg-light">
            <div class="col-12 text-center">
                <h1>Contact Us</h1>
            </div>
            <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="col-12">
                <label for="contact_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="contact_email" name="contact_email" value="<?php echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'? $_SESSION['loggedin_email'] : ''); ?>" required>
            </div>
            <div class="col-12">
                <label for="contact_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="contact_name" name="contact_name" required>
            </div>
            <div class="col-12">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" minlength="10" maxlength="13" pattern="[0-9]+" required>
            </div>
            <div class="col-12">
                <label for="contact_description" class="form-label">Description</label>
                <textarea name="contact_description" class="form-control" id="contact_description" placeholder="Reason..." required></textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
</div>

</section>
<!-- footer included -->
<?php include 'partial/_footer.php' ?>