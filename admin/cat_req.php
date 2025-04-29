<?php
    session_start();
?>
<?php include 'partials/_header.php' ?>
<?php include 'partials/_navBar.php' ?>
<?php include 'partials/_leftNav.php' ?>

<?php
      // delete category
      if(isset($_POST['deleteCategoryReq'])){
        $categoryReqId = $_POST['categoryReqId'];
        // die;
        $deleteResult = mysqli_query($conn,"UPDATE category_requests SET req_status = 2 WHERE request_id = $categoryReqId");
        if($deleteResult){
            echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <strong>Success !</strong> Category Request has been rejected successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
            <strong>Error !</strong> Somthing went wrong.Please try again
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }


      // accept category
      if(isset($_POST['acceptCategoryReq'])){
        $categoryAcceptReqId = $_POST['categoryAcceptReqId'];
        $categoryReqTitle = $_POST['categoryReqTitle'];
        // die;
        $catAddResult = mysqli_query($conn,"INSERT INTO categories (category_name) VALUES('$categoryReqTitle')");
        if($catAddResult){
            $acceptResult = mysqli_query($conn,"UPDATE category_requests SET req_status = 1 WHERE request_id = $categoryAcceptReqId");
            if($acceptResult){
                echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
                <strong>Success !</strong> Category Request has been rejected successfully
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }else{
                echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
                <strong>Error !</strong> Somthing went wrong.Please try again
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }else{
                echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
                <strong>Error !</strong> Somthing went wrong.Please try again
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }
    
?>

<?php
    include '../partial/_dbconnection.php';
    if ($_SESSION['loggedin'] == true) {
    $resultUser =mysqli_query($conn, 'SELECT * FROM users');
    $resultUserCount = mysqli_num_rows($resultUser);
    $resultUserActive =mysqli_query($conn, 'SELECT * FROM users WHERE is_deleted = 0');
    $resultUserActiveCount = mysqli_num_rows($resultUserActive);
    $resultCateogy =mysqli_query($conn, 'SELECT * FROM categories WHERE is_deleted = 0');
    $resultCateogyCount = mysqli_num_rows($resultCateogy);
    $resultCateogyRequest =mysqli_query($conn, 'SELECT * FROM category_requests WHERE req_status = 0');
    $resultCateogyRequestCount = mysqli_num_rows($resultCateogyRequest);
    $resultCateogyRequestQry =mysqli_query($conn, 'SELECT * FROM category_requests');
    $resultCateogyRequestQryCount = mysqli_num_rows($resultCateogyRequestQry);
    }else{
        header('location: index.php');
    }



?>

<div class="admin-home-div col-12 container">
    <h2 class="py-3 px-2 my-3">Category Requests</h2>
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
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Request Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($resultCateogyRequestQryCount > 0){
                        while($row = mysqli_fetch_assoc($resultCateogyRequestQry)){
                            $statusAction =  $row['req_status'] == 1 || $row['req_status'] == 2 ? 'd-none' : '';
                            echo ' <tr>
                                    <th>'.$row['request_id'].'</th>
                                    <th>'.$row['req_categ_name'].'</th>
                                    <th>'.$row['req_categ_description'].'</th>
                                    <th>'.username($row['req_user_id']).'</th>
                                    <th>'.$row['created_at'].'</th>
                                    <th>'.requestStatus($row['req_status']).'</th>
                                    <th>
                                    <div class="btn-group '.$statusAction.'" role="group" aria-label="Basic mixed styles example" >
                                        <button type="button" class="accept-Request btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#acceptCatReqModal">Accept</button>
                                        <button type="button" class="reject-Category btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteCatReqModal">Reject</button>
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



<!-- reject model -->

<div class="modal fade" id="deleteCatReqModal" tabindex="-1" aria-labelledby="deleteCatReqModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteCatReqModalLabel">Reject Category Request</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="categoryReqId" id="categoryReqId">
                <h5>Dou yo really want to reject request</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" name="deleteCategoryReq">Reject</button>
        </div>
        </div>
    </form>
  </div>
</div>


<!-- accept model -->
<div class="modal fade" id="acceptCatReqModal" tabindex="-1" aria-labelledby="acceptCatReqModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="acceptCatReqModalLabel">Accept Category Request</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="categoryAcceptReqId" id="categoryAcceptReqId">
            <input type="hidden" name="categoryReqTitle" id="categoryReqTitle">
                <h5>Dou yo really want to accept request</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="acceptCategoryReq">Accept</button>
        </div>
        </div>
    </form>
  </div>
</div>



<script>
    // let table = new DataTable('#cat-table');

    let rejectCategoryRequests =  document.getElementsByClassName('reject-Category');
    // console.log('consolel',rejectCategoryRequests);
    
    Array.from(rejectCategoryRequests).forEach(deletebutton=>{
        deletebutton.addEventListener('click',function(){
            let row = deletebutton.closest('tr');
            if(row){
                let cells = row.querySelectorAll('th');
                let values = Array.from(cells).map(cell => cell.textContent.trim() );
                console.log(values[0]);

                
                document.getElementById('categoryReqId').value = values[0];
            }
            // console.log(row);
        });
    });

    // accept request
    let acceptCategoryRequests =  document.getElementsByClassName('accept-Request');
    console.log('consolel',acceptCategoryRequests);
    
    Array.from(acceptCategoryRequests).forEach(accceptdeletebutton=>{
        accceptdeletebutton.addEventListener('click',function(){
            let row = accceptdeletebutton.closest('tr');
            if(row){
                let cells = row.querySelectorAll('th');
                let values = Array.from(cells).map(cell => cell.textContent.trim() );
                console.log(values[0]);

                
                document.getElementById('categoryAcceptReqId').value = values[0];
                document.getElementById('categoryReqTitle').value = values[1];
            }
            // console.log(row);
        });
    });
</script>

<?php include 'partials/_footer.php' ?>