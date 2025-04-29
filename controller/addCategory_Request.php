<?php
    include "../partial/_dbconnection.php";
    include "../partial/_helper.php";
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // print_r($_POST);
        // echo "<br>";
        $categRequestMessage = false;

        if($_POST['category_name']){
            $category_name = $_POST['category_name'];
            $category_name = sanatise('<',$category_name);
            $category_name = sanatise('>',$category_name);

            $category_description = $_POST['category_description'];
            $category_description = sanatise('<',$category_description);
            $category_description = sanatise('>',$category_description);

            $loggedin_user_id = $_SESSION['loggedin_id'];

            $sqlcategRequest = "INSERT INTO `category_requests` (`req_categ_name`,`req_categ_description`,`req_user_id`) VALUES('$category_name','$category_description','$loggedin_user_id')";
            $resultcategRequest = mysqli_query($conn, $sqlcategRequest);
            if($resultcategRequest){
                header("location: ../request-to-add-category.php?categRequestMessage=true&page=catRequest");
            }else{
                header("location: ../request-to-add-category.php?categRequestMessage=false&page=catRequest");
            }
        }

    }
}
?>