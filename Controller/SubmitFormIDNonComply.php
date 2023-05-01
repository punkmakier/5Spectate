<?php
    require_once '../Model/SubmitForms.php';
    $submit = new SubmitForms;

    if(isset($_POST['formItemID'])){
        $formID = $_POST['formItemID'];
        $roomNum = $_POST['roomNum'];
        $typeComply = $_POST['typeComply'];
        $desc = $_POST['Description'];
        $Auditor = $_POST['AuditorName'];
        $dateToday = date("Y-m-d H:i:s");

        $img_name = $_FILES['filename']['name'];
        $tmp_name = $_FILES['filename']['tmp_name'];

        $uniqkeyID = uniqid();

        $signatures_img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $signatures_img_ex_lc = strtolower($signatures_img_ext);

        $final_new_name = uniqid("noncomply",true).'.'.$signatures_img_ex_lc;
        $img_upload_path = "../NonComplyImages/".$final_new_name;
            
        if($submit->submitSaveFormNonComply($uniqkeyID,$formID,$roomNum,$typeComply,$desc,$final_new_name,$Auditor,$dateToday)){
            move_uploaded_file($tmp_name, $img_upload_path);
            echo "Success";
        }else{
            echo "Failed";
        }
    }


?>