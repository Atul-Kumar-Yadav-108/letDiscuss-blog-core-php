<?php
    include "../partial/_dbconnection.php";
    include "../partial/_helper.php";
       session_start(); 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // print_r($_POST);
                // echo "<br>";
                $questionMessage = false;

                $catdi = $_GET['catId'];
                if($_POST['ques_title']){
                    $ques_title = $_POST['ques_title'];
                    $ques_title = sanatise('<',$ques_title);
                    $ques_title = sanatise('>',$ques_title);

                    $floatingTextarea = $_POST['floatingTextarea'];
                    $floatingTextarea = sanatise('<',$floatingTextarea);
                    $floatingTextarea = sanatise('>',$floatingTextarea);

                    $loggedin_idQuestion = $_SESSION['loggedin_id'];
                    
                    $sqlQuestion = "INSERT INTO `questions` (`question_title`,`quesition_description`,`category_id`,`creator_user_id`) VALUES('$ques_title','$floatingTextarea','$catdi','$loggedin_idQuestion')";
                    $resultQuestion = mysqli_query($conn, $sqlQuestion);
                    if($resultQuestion){
                        header("location: ../forumlist.php?questionMessage=true&page=formumlist&catid=$catdi");
                    }else{
                        header("location: ../forumlist.php?questionMessage=false&page=formumlist&catid=$catdi");
                    }
                }

            }
    }
?>