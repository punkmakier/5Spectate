<?php 

    require_once '../Model/DisplayTable.php';
    $display = new DisplayTable;
    if(isset($_POST['SelectedID'])){
        $display->showAuditHistory($_POST['SelectedID']);

    }


?>