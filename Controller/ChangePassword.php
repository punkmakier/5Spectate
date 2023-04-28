<?php

    require_once '../Model/UserAuth.php';
    $user = new UserAuth;

    if(isset($_POST['UserID'])){
        $UserID = trim($_POST['UserID']);
        $oldPass = trim($_POST['oldPass']);
        $newPass = trim($_POST['newPass']);
        $connewPass = trim($_POST['connewPass']);

        if($newPass != $connewPass){
            echo "DoNotMatch";
        }else if(strlen($newPass) < 4){
            echo "Short";
        }else{
            $user->userChangePass($UserID,$oldPass, $newPass);
        }

    }



?>