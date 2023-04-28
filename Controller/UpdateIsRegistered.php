<?php

    require_once '../Model/UserAuth.php';
    $user = new UserAuth;

    if(isset($_POST['UserID'])){
        $UserID = trim($_POST['UserID']);

        if($user->updateRegistered($UserID)){
            echo "Success";
        }else{
            echo "Failed";
        }

    }



?>