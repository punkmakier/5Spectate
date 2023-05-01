<?php

    require_once '../Model/SubmitForms.php';
    $submit = new SubmitForms;

    if(isset($_POST['FormID'])){
        $formID = $_POST['FormID'];
        $roomID = $_POST['RoomID'];
        $Type = $_POST['Type'];
        $AudName = $_POST['AudName'];
        

        if($submit->submitSaveForm($formID,$roomID,$Type,$AudName)){
            echo "Success";
        }else{
            echo "Failed";
        }
    }



?>