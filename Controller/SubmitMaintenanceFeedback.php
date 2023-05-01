<?php
    require_once '../Model/SubmitSupport.php';
    $submit = new SubmitSupport;

    if(isset($_POST['Description'])){
        $fname = $_POST['completename'];
        $description = $_POST['Description'];
        $status = $_POST['status'];
        $uniqueID = $_POST['uniqueID'];

        $img_name = $_FILES['filename']['name'];
        $tmp_name = $_FILES['filename']['tmp_name'];


        $signatures_img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $signatures_img_ex_lc = strtolower($signatures_img_ext);

        $final_new_name = uniqid("maintenancefeedback",true).'.'.$signatures_img_ex_lc;
        $img_upload_path = "../MaintenanceFeedback/".$final_new_name;

        if($submit->submitMaintenance($fname,$description,$status,$final_new_name,$uniqueID)){
            move_uploaded_file($tmp_name, $img_upload_path);
            echo "Success";
        }else{
            echo "Failed";
        }


    }


?>