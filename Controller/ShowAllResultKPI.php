<?php

    require_once '../Model/KPISystemFunction.php';
    $kpi = new KPISystemFunction;

    if(isset($_POST['Action']) == "ThisSelected"){
        echo $kpi->showCountAll($_POST['SelectedCount']);
    }


?>