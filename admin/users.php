<?php
    session_start();
?>
<?php include 'partials/_header.php' ?>
<?php include 'partials/_navBar.php' ?>
<?php include 'partials/_leftNav.php' ?>

<?php
    // delete users
    if(isset($_GET['deleteid'])){
        $deleleId = $_GET['deleteid'];
        // die;
        $deleteResult = mysqli_query($conn,"UPDATE users SET is_deleted = 1 WHERE id = $deleleId");
        if($deleteResult){
            echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <strong>Success !</strong> Users has been deleted successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
            <strong>Error !</strong> Somthing went wrong.Please try again
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }


    // edit or update users details
    if(isset($_POST['edit-user'])){

        $updateId = $_POST['userid'];
        $updateUsername = $_POST['edit-username'];
        $updateEditStatus = $_POST['edit-status'];
        // die;
        $deleteResult = mysqli_query($conn,"UPDATE users SET username = '$updateUsername' , account_status = $updateEditStatus  WHERE id = $updateId");
        if($deleteResult){
            echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <strong>Success !</strong> Users has been updated successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
            <strong>Error !</strong> Somthing went wrong.Please try again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }

    
?>


<?php
    include '../partial/_dbconnection.php';
    if($_SESSION['loggedin']== true){
    
    $resultUser =mysqli_query($conn, 'SELECT * FROM users');
    $resultUserCount = mysqli_num_rows($resultUser);
    $resultUserActive =mysqli_query($conn, 'SELECT * FROM users WHERE is_deleted = 0');
    $resultUserActiveCount = mysqli_num_rows($resultUserActive);
    $resultCateogy =mysqli_query($conn, 'SELECT * FROM categories WHERE is_deleted = 0');
    $resultCateogyCount = mysqli_num_rows($resultCateogy);
    $resultCateogyRequest =mysqli_query($conn, 'SELECT * FROM category_requests WHERE req_status = 0');
    $resultCateogyRequestCount = mysqli_num_rows($resultCateogyRequest);
        # code...
    }else{
        header('location: index.php');
    }
?>

<div class="admin-home-div col-12 container">
    <h2 class="py-3 px-2 my-3">Users</h2>
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

    <div class="category-deatils-data mt-4 bg-light rounded ">
        <table class="table table-striped" id="cat-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($resultUserActiveCount > 0){
                        while($row = mysqli_fetch_assoc($resultUserActive)){
                            echo ' <tr>
                                    <th>'.$row['id'].'</th>
                                    <th>'.$row['user_email'].'</th>
                                    <th>'.$row['username'].'</th>
                                    <th>'.accountStatus($row['account_status']).'</th>
                                    <th>'.$row['created_at'].'</th>
                                    <th>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="user-edit btn btn-outline-info" data-bs-target="#userEditModal" data-bs-toggle="modal">Edit</button>
                                        <a href="users.php?deleteid='.$row['id'].'"  class="btn btn-outline-danger">Delete</a>
                                    </div>
                                    </th>
                                </tr>';
                        }
                    }
                ?>
               
            </tbody>
        </table>
    </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="userEditModalLabel">Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="userid" id="userid" value="">
            <div class="username-container">
                Username  <input type="text" name="edit-username" class="form-control" id="edit-username">
            </div>
            <div class="username-container">
                Username  
                <select name="edit-status" id="edit-status" class="form-control">
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="edit-user">Update</button>
        </div>
        </div>
    </form>
  </div>
</div>



<script>
    let adminEdits = document.getElementsByClassName('user-edit');
    // console.log(adminEdits);
    Array.from(adminEdits).forEach(button => {
        button.addEventListener('click',function(){
            let row = button.closest('tr');
            console.log(row);
            if(row){
                let cells = row.querySelectorAll('th');
                let values = Array.from(cells).map(cell => cell.textContent.trim());
                document.getElementById('userid').value = values[0];
                document.getElementById('edit-username').value = values[2];
                if(values[3] == 'Active'){
                    document.getElementById('edit-status').value = 0;
                }else{
                    document.getElementById('edit-status').value = 1;
                }
                console.log(values[3]);
                
                
            }
            
        })
    })

    
    
</script>


<?php include 'partials/_footer.php' ?>