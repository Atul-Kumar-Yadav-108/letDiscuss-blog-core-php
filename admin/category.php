<?php
    session_start();
?>
<?php include 'partials/_header.php' ?>
<?php include 'partials/_navBar.php' ?>
<?php include 'partials/_leftNav.php' ?>


<?php
    // delete category
    if(isset($_POST['deleteCategory'])){
        $categoryId = $_POST['categoryId'];
        // die;
        $deleteResult = mysqli_query($conn,"UPDATE categories SET is_deleted = 1 WHERE category_id = $categoryId");
        if($deleteResult){
            echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <strong>Success !</strong> Category has been deleted successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
            <strong>Error !</strong> Somthing went wrong.Please try again
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }


    // edit category
    if(isset($_POST['updateCategory'])){
        $editCategoryId = $_POST['editCategoryId'];
        $editCategoryTitle = $_POST['categoryTitle'];
        $editCategoryDescription = $_POST['catDescription'];
        // die;
        $editCategoryResult = mysqli_query($conn,"UPDATE categories SET category_name = '$editCategoryTitle', category_description = '$editCategoryDescription' WHERE category_id = $editCategoryId");
        if($editCategoryResult){
            echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <strong>Success !</strong> Category has been updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
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
    if($_SESSION['loggedin']== true){
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
    <h2 class="py-3 px-2 my-3">Category</h2>
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
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($resultCateogyCount > 0){
                        while($row = mysqli_fetch_assoc($resultCateogy)){
                            echo ' <tr>
                                    <th>'.$row['category_id'].'</th>
                                    <th>'.$row['category_name'].'</th>
                                    <th>'.$row['category_description'].'</th>
                                    <th>'.$row['created_by'].'</th>
                                    <th>'.$row['created_at'].'</th>
                                    <th>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="editCat btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editCatModal">Edit</button>
                                        <button type="button" class="deleteCat btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteCatModal">Delete</button>
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


<!-- delete model -->

<div class="modal fade" id="deleteCatModal" tabindex="-1" aria-labelledby="deleteCatModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteCatModalLabel">Delete Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="categoryId" id="categoryId">
                <h5>Dou yo really want to delete</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" name="deleteCategory">Delete</button>
        </div>
        </div>
    </form>
  </div>
</div>


<!-- edit model -->

<div class="modal fade" id="editCatModal" tabindex="-1" aria-labelledby="editCatModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editCatModalLabel">Edit Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="editCategoryId" id="editCategoryId">
            <div class="username-container">
                <label for="" class="form-label">Title</label> <input type="text" name="categoryTitle" class="form-control" id="categoryTitle">
            </div>
            <div class="username-container">
                <label for="" class="form-label">Descritpion</label>  
                <textarea name="catDescription" id="catDescription" class="form-control" cols="25" rows="5" placeholder="Enter description here"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="updateCategory">Update</button>
        </div>
        </div>
    </form>
  </div>
</div>


<?php include 'partials/_footer.php' ?>

<script>
    // let table = new DataTable('#cat-table');


    // delete
    let deleteCaegories =  document.getElementsByClassName('deleteCat');
    console.log(deleteCaegories);
    
    Array.from(deleteCaegories).forEach(deletebutton=>{
        deletebutton.addEventListener('click',function(){
            let row = deletebutton.closest('tr');
            if(row){
                let cells = row.querySelectorAll('th');
                let values = Array.from(cells).map(cell => cell.textContent.trim() );
                console.log(values[0]);

                
                document.getElementById('categoryId').value = values[0];
            }
            // console.log(row);
        });
    });

    let editCategoreis = document.getElementsByClassName('editCat');
    Array.from(editCategoreis).forEach(editButton=>{
        editButton.addEventListener('click',function(){
           let row = editButton.closest('tr');
            
           let cells =  row.querySelectorAll('th');

           let values = Array.from(cells).map(cell => cell.textContent.trim());
        //    console.log(values);
           document.getElementById('editCategoryId').value = values[0];
           document.getElementById('categoryTitle').value = values[1];
           document.getElementById('catDescription').value = values[2];
           
        });
    })
</script>