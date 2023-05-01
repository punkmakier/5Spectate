<?php 
    require_once '../Model/UserAuth.php';
    $user = new UserAuth;
    
    if(isset($_POST['Username'])){
        
        $username = trim($_POST['Username']);
        $password = trim($_POST['Password']);
        $usertype = trim($_POST['UserType']);
        $roomIncharge = trim($_POST['roomIncharge']);
        $confirmPass = trim($_POST['ConfirmPass']);
        $UniqueKey = uniqid();
        
        if($confirmPass != $password){
            echo "DoNotMatch";
        }
        elseif(strlen($password) < 4){
            echo "Short";
        }else{
            if($user->registerAccount($username, $password, $usertype, $UniqueKey,$roomIncharge)){
                echo "Success";
            }else{
                echo "Failed";
            }
        }
        
    }


?>