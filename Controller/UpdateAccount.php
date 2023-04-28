<?php

    require_once '../Model/UserAuth.php';
    $user = new UserAuth;


    if(isset($_POST['UserID'])){
        $userID = $_POST['UserID'];
        $firstname = $_POST['Firstname'];
        $middlename = $_POST['Middlename'];
        $lastname = $_POST['Lastname'];
        $ProfessionID = $_POST['ProfessionID'];

        if($user->updateAccount($userID,$firstname,$middlename,$lastname,$ProfessionID)){
            echo "Success";
        }else{
            echo "Failed";
        }
    }



?>