<?php

    require_once '../Model/UserAuth.php';
    $user = new UserAuth;

    if(isset($_POST['Username'])){
        $username = trim($_POST['Username']);
        $password = trim($_POST['Password']);

        $user->userLogin($username, $password);

    }



?>