<?php


    require_once '../Model/SubmitSupport.php';
    $submit = new SubmitSupport;

    if(isset($_POST['Maintenance'])){
        $maintenance = $_POST['Maintenance'];
        $Description = $_POST['Description'];
        $TeacherName = $_POST['TeacherName'];
        $TeacherID = $_POST['TeacherID'];
        $Department = $_POST['Department'];
        
        $img_name = $_FILES['filename']['name'];
        $tmp_name = $_FILES['filename']['tmp_name'];

        $uniqkeyID = uniqid();

        $signatures_img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $signatures_img_ex_lc = strtolower($signatures_img_ext);

        $final_new_name = uniqid("supportsystem",true).'.'.$signatures_img_ex_lc;
        $img_upload_path = "../SupportSystem/".$final_new_name;

        if($submit->submitSupportSys($uniqkeyID,$maintenance,$Description,$final_new_name,$TeacherName,$TeacherID,$Department)){
            move_uploaded_file($tmp_name, $img_upload_path);
            echo "Success";
        }else{
            echo "Failed";
        }
            
    }



?>