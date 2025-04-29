<section>


<!-- header included -->
<?php include 'partial/_header.php' ?>

<?php
   if(isset($_GET['page']) && $_GET['page'] =='formumlist' && $_GET['questionMessage'] == 'true'){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Tread has been added successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
   }elseif(isset($_GET['page']) && $_GET['page'] =='formumlist' && $_GET['questionMessage']  == 'false'){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Some Error occur while adding thread.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
   }
?>

<?php
        $category_id = $_GET['catid'];
        $catList = "SELECT * FROM `categories` WHERE category_id = $category_id";
        $catListResult = mysqli_query($conn,$catList);
        $catRow = mysqli_fetch_row($catListResult);
        $cat_name = $catRow[1];
        $cat_description = $catRow[2];
        // print_R($catRow);


?>

<div class="container py-5">
        <h3 class="text-center mb-4"><span class="text-success fst-italic fw-bold">LetDiscuss</span>- Forums</h3>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"><?php echo $cat_name; ?></h4>
            <p><?php echo $cat_description; ?></p>
            <hr>
            <h5>Rules : </h5>
            <p class="mb-0">Treat others with kindness and avoid personal attacks.Discrimination, racism, sexism, or any form of harassment is prohibited.Keep discussions relevant to the forum's purpose.Avoid excessive posting, advertisements, or self-promotion. Don't intentionally provoke or disrupt discussions.</p>
        </div>
</div>

<div class="container mb-3 pb-2 border rounded">
        <h3>Ask Question</h3>
        <form action="controller/forumlistController.php?catId=<?php echo $category_id?>" method="post">
                <div class="mb-3">
                    <label for="ques_title" class="form-label">Question Title</label>
                    <input type="text" class="form-control" id="ques_title" name="ques_title" placeholder="Enter your doubt here!!" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Question Description</label>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="floatingTextarea" required></textarea>
                        <label for="floatingTextarea">Enter description here!!!</label>
                    </div>
                </div>
                <?php
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
                        echo '<button type="submit" class="btn btn-primary">Ask a Question</button>';
                    }else{
                       echo '<button type="button" class="btn btn-primary" data-bs-toggle="popover" title="Warning" data-bs-content="Please login first to ask a question">Ask a Question</button>';
                    }
                    ?>
        </form>
</div>


<div class="container">
<div class="container my-5">
        <h2>Browse Questions</h2>
            <?php
                        $batchSize = 10;
                        $page = isset($_GET['page']) ? (int) $_GET['page'] :  1;
                        $offset = ($page - 1) * $batchSize;
                        
                        // $sqlForumlist = "SELECT * FROM `questions` WHERE `category_id` = $category_id LIMIT 10";
                        $sqlForumlist = "SELECT * FROM `questions` WHERE `category_id` = $category_id LIMIT $batchSize OFFSET $offset";
                        $resultForumList = mysqli_query($conn, $sqlForumlist);
                        $forumlistcount = mysqli_num_rows($resultForumList);

                        $totalRows = mysqli_query($conn,("SELECT COUNT(question_id) AS total_rows FROM `questions` WHERE `category_id` = $category_id"));
                        $totalRows = mysqli_fetch_row($totalRows);
                        $totalRows = $totalRows[0];
                        $totalPages = ceil($totalRows / $batchSize);
                        // echo $totalPages;
                        // die;
                        
                if($forumlistcount>0){
                    while($forumListRow = mysqli_fetch_assoc($resultForumList)){
               echo '<div class="d-flex align-items-center my-3 bg-light px-3 py-1">
                    <div class="flex-shrink-0">
                        <img src="../letDiscuss/public/images/download.jpg" width="54px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex justify-content-between">
                        <h5 class="mt-0"> <a href="forum.php?quesId='.$forumListRow['question_id'].'">'.$forumListRow['question_title'].'</a></h5>
                        <p><b>'.username($forumListRow['creator_user_id']).'</b> '.$forumListRow['created_at'].' </p>
                        </div>
                        <p>'.$forumListRow['quesition_description'].'</p>
                    </div>
                </div>';
                    }

                    echo '<div class="navigation-button d-flex justify-content-between">
                            <a href="forumlist.php?catid='.$category_id.'&page='.($page - 1) .'" class="btn bg-primary text-white mx-2 ' . ($page == 1 ? 'disabled' : '') . '">Previous</a>
                            <a href="forumlist.php?catid='.$category_id.'&page='.($page + 1) .'" class="btn bg-primary text-white mx-2 ' . ($page == $totalPages ? 'disabled' : '') . '">Next</a>
                        </div>';
            
                }else{
                    echo '<div class=" my-3 bg-light px-3 py-1">
            <h5 class="text-center">No Comment available. Be the first to ask question.</h5>
            </div>';
                }
            ?>
    </div>
</div>

</section>
<!-- footer included -->
<?php include 'partial/_footer.php' ?>