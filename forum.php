<section>
<!-- header included -->
<?php include 'partial/_header.php' ?>

<!-- <?php
    if(isset($_GET['quesId'])){
        echo $_GET['quesId'];
    }
?> -->

<?php

if($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_GET['quesId'])){
        $quesId = $_GET['quesId'];

        $sql = "SELECT * FROM `questions` WHERE `question_id` = $quesId";
        $record = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($record);
        $treadname = $row[1];
        $treadDescription = $row[2];
        $postedBy = $row[4];

        // $threadSql = "SELECT * FROM `threads` WHERE `thread_cat_id` = $quesId";
        // $threadResult = mysqli_query($conn, $threadSql);

        // $threadRows = mysqli_num_rows($threadResult);
    }
}
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_GET['quesId']){
                $quesId = $_GET['quesId'];
                $quesId = sanatise('<',$quesId);
                $quesId = sanatise('>',$quesId);
                
                $quesComment = $_POST['ques_comment'];
                $quesComment = sanatise('<',$quesComment);
                $quesComment = sanatise('>',$quesComment);
                
                $createdbyuserid = $_SESSION['loggedin_id'];

                $commentsql = "INSERT INTO `comments` (`comment_content`,`question_id`,`created_by`) VALUES('$quesComment','$quesId','$createdbyuserid')";
                $commentrecord = mysqli_query($conn, $commentsql);
                if($commentrecord){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Comment posted successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
        }
}

?>

<div class="container">
<div class="bg-light p-5 rounded-lg">
    <h2 class="display-5"><?php echo $treadname?></h2>
    <p class="lead"><b>Description : </b><?php echo $treadDescription ?></p>
    <hr class="my-4">
    <p>This is peer to peer forum for sharing knowledge with each other.Remain respectful of other members at all times and make decorum of quesitions and response/Dont promote presonal interest like gameing etc, comment related to the topic.</p>
    <p>Posted By: <b><?php echo username( $postedBy); ?></b></p>
    <!-- <p><a class="btn btn-success btn-lg" href="#" role="button">Learn more</a></p> -->
</div>
</div>

<div class="container border p-4 border-dark my-5 rounded" style="box-sizing: border-box;">
<h2>Post a Comment</h2>
<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
<div class="mb-3">
    <label for="ques_comment" class="form-label">Write your comment</label>
    <textarea class="form-control" placeholder="Leave a comment here" id="ques_comment" name="ques_comment" required></textarea>
</div>
<?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
            echo '<button type="submit" class="btn btn-primary">Post Comment</button>';
          }else{
            echo '<button type="button" class="btn btn-primary" data-bs-toggle="popover" title="Warning" data-bs-content="Please login first to post a comment">Post Comment</button>';
          }

?>
</form>
</div>

<div class="container my-5">
<h2>Discussions</h2>

<?php


$commentSql = "SELECT * FROM `comments` WHERE `question_id` = $quesId";
$commentResult = mysqli_query($conn, $commentSql);

$commentRows = mysqli_num_rows($commentResult);
if($commentRows > 0){
while($commentRow = mysqli_fetch_assoc($commentResult)){
    echo '<div class="d-flex align-items-center my-3 bg-light px-3 py-1">
        <div class="flex-shrink-0">
            <img src="../letDiscuss/public/images/tradimg.jpg" width="54px" alt="...">
        </div>
        <div class="flex-grow-1 ms-3">
            <div class="d-flex justify-content-between">
            <h5 class="mt-0"><b>'.username($commentRow['created_by']).'</b></h5>
            <p>Commented at : '.$commentRow['created_at'].'</p>
            </div>
            <p>'.$commentRow['comment_content'].'</p>
        </div>
    </div>';
}
}else{
echo '<div class=" my-3 bg-light px-3 py-1">
<h5 class="text-center">No Comment available. Be the first to comment</h5>
</div>';
}
?>
</div>


</section>
<!-- footer included -->
<?php include 'partial/_footer.php' ?>