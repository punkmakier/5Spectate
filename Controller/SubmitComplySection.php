<?php

    require_once '../Model/SubmitNonComplianceFeedback.php';
    $submit = new SubmitNonComplianceFeedback;

    if(isset($_POST['ComplyID'])){
        $complyID = $_POST['ComplyID'];
        $desc = $_POST['Desc'];
        $cname = $_POST['cname'];
        
        
        $img_name = $_FILES['filename']['name'];
        $tmp_name = $_FILES['filename']['tmp_name'];

        $signatures_img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $signatures_img_ex_lc = strtolower($signatures_img_ext);

        $final_new_name = uniqid("submitnoncomply",true).'.'.$signatures_img_ex_lc;
        $img_upload_path = "../SubmittedCompliance/".$final_new_name;

        if($submit->submitNonCompliance($complyID,$desc,$final_new_name,$cname)){
            move_uploaded_file($tmp_name, $img_upload_path);
            echo "Success";
        }else{
            echo "Failed";
        }
    }


?>