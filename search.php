<section>
    
<!-- header included -->
<?php include 'partial/_header.php' ?>


<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // echo $_GET['queries'];
        $Query = $_GET['queries'];

        $sqlSearch = "SELECT * FROM `questions` WHERE MATCH(question_title,quesition_description) AGAINST('$Query')";
        $resultSearch = mysqli_query($conn, $sqlSearch);
        // print_r(mysqli_fetch_all($resultSearch));
        
    }
    // $sqlSearch = ""
?>

<div class="container d-flex flex-column align-items-start my-5">
        <h2> Search Result for <span class="text-succes fst-italic fw-bold text-success px-2 py-1"><?php echo $_GET['queries'];?></span></h2>
        <div class="serachResult row ms-5">
            <?php
            if(mysqli_num_rows($resultSearch)> 0){
                while($searchedRow = mysqli_fetch_assoc($resultSearch)){
                    $url = "forum.php?quesId=".$searchedRow['question_id'];
                    echo '<div class="searched-result py-2">
                            <h4><a href="'.$url.'">'.$searchedRow['question_title'].'</a></h4>
                            <div>
                                <p class="ps-3">'.$searchedRow['quesition_description'].'</p>
                            </div>
                        </div>';
                }
            }else{
                echo '<div class=" col-12 my-3 bg-light px-3 py-1">
                        <h5 class="text-center block">No match found</h5>
                    </div>';
            }
            ?>
        </div>
</div>

</section>
<!-- footer included -->    
<?php include 'partial/_footer.php' ?>
