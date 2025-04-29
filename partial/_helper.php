<?php
    include '_dbconnection.php';

    function username($id){
        // echo "$id";
        if($id){
        global $conn;
        $sqlUsername = "SELECT username FROM `users` WHERE `id` = '$id'";
        $resultUsername = mysqli_query($conn , $sqlUsername);
        $matchedUsername = mysqli_fetch_row($resultUsername);
        $matchedUsername = $matchedUsername[0];
        return $matchedUsername;
        }else{
            return;
        }
    }
    function requestStatus($id){
        $cat_status = '';
        if($id == 0){
            $cat_status = '<span class="text-warning">panding</span>';
        }elseif($id == 1){
            $cat_status = '<span class="text-success">accepted</span>';
        }elseif($id == 2){
            $cat_status = '<span class="text-danger">rejected</span>';
        }
        return $cat_status;
    }

    function accountStatus($id){
        $acc_status = '';
        if($id == 0){
            $acc_status = '<span class="text-success">Active</span>';
        }elseif($id == 1){
            $acc_status = '<span class="text-danger">Inactive</span>';
        }
        return $acc_status;
    }


    // senatize < or > 
    function sanatise($symbol, $file){
        $convertedFile = "";
        if($symbol == "<"){
            $convertedFile = str_replace($symbol, "&lt", $file);
        }elseif($symbol == ">"){
            $convertedFile = str_replace($symbol, "&gt", $file);
        }

        return $convertedFile;
    }
?>