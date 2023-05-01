<?php

    require_once '../Model/DisplayTable.php';
    $show = new DisplayTable;

    if(isset($_POST['itemId'])){
        
        $show->showFeedbackDetails($_POST['itemId']);
    }

?>