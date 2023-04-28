<?php

    require_once '../Model/SubmitForms.php';
    $submit = new SubmitForms;

    if(isset($_POST['FormID'])){
        $formID = $_POST['FormID'];
        $roomID = $_POST['RoomID'];
        $Type = $_POST['Type'];

        if($submit->submitSaveForm($formID,$roomID,$Type)){
            echo "Success";
        }else{
            echo "Failed";
        }
    }



?>