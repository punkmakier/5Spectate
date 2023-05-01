<?php 
    require_once '../Model/DisplayTable.php';
    $display = new DisplayTable;

    if(isset($_POST['SelectedID'])){
        $selectedID = $_POST['SelectedID'];

        $display->displaySubmittedCompliance($selectedID);
      
           


    }
    ?>

