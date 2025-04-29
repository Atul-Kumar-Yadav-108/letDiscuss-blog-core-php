<section>
    
<!-- header included -->
<?php include 'partial/_header.php' ?>
<?php include 'partial/_carousel.php' ?>

<div class="container d-flex flex-column align-items-center my-5">
        <h2><span class="text-succes fst-italic fw-bold text-success px-2 py-1">letDiscuss</span> : Categories</h2>
        <div class="categories row ms-5">
            <?php
                $cat_sql = "SELECT * FROM `categories` WHERE `is_deleted` = 0";
                $cat_result = mysqli_query($conn, $cat_sql);
                $cat_count = mysqli_num_rows($cat_result);
                if($cat_count > 0){
                    while ($row = mysqli_fetch_assoc($cat_result)) {
                        # code...echo 
                        echo '                <div class="card text-center col-4 mx-5 my-4" style="width: 18rem;">
                    <img src="public/images/download.jpg" class="card-img-top" alt="..." width="200px" height="200px;">
                    <div class="card-body">
                        <h5 class="card-title">'.$row['category_name'].'</h5>
                        <p class="card-text text-start">'.substr($row['category_description'],0,50).'...</p>
                        <a href="forumlist.php?catid='.$row['category_id'].'" class="btn btn-primary">Visit Forums</a>
                    </div>
                </div>';
                    }
                }
            ?>  
        </div>
</div>

</section>
<!-- footer included -->    
<?php include 'partial/_footer.php' ?>
