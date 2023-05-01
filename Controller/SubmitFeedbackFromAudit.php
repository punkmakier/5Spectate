<?php

    require_once '../Model/SubmitNonComplianceFeedback.php';
    $submit = new SubmitNonComplianceFeedback;

    if(isset($_POST['compliedID'])){
        $feedback = $_POST['YourFeedback'];
        $Status = $_POST['Status'];
        $id = $_POST['compliedID'];

        if($submit->submitFeedbackAudit($id,$feedback,$Status)){
            echo "Success";
        }else{
            echo "Failed";  
        }
    }


?>