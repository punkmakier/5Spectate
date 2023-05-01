<?php 
    require_once 'config.php';

    class KPISystemFunction extends config
    {
        public function showCountAll($selected){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM evaluated_form WHERE room_id = '$selected' AND Type='NonComplying'");
            if($sqlQ->execute()){
                $sqlQ1 = $con->prepare("SELECT COUNT(*) AS Counted FROM evaluated_form WHERE room_id = '$selected' AND Type='NonComplying'");
                $sqlQ1->execute();
                $result = $sqlQ1->fetch();
                $counted = $result['Counted'];
                $table = "
                
                <span style='font-weight: 600; font-size: 1.5rem; color: green;'>Total Count: {$counted} </span>
                
                <table class='table table-striped mt-3'><thead class='bg-primary text-center text-white'>
                <tr>
                <th>Form ID</th>
                <th>Type</th>
                <th>Description</th>    
                <th>Attachment</th>    
                <th>Status</th>    
                <th>Auditor Name</th>    
                <th>Date Created</th>    
                </tr>
                </thead><tbody>";
                while($row = $sqlQ->fetch()){
                    $formID = $row['form_id'];
                    $Type = $row['Type'];
                    $Description = $row['Description'];
                    $FileName = $row['FileName'];
                    $Status = $row['Status'];
                    $AuditorName = $row['AuditorName'];
                    $DateCreated = $row['DateCreated'];
                    $statusColor = "";
                    if($Status == "Resolve"){
                        $statusColor = "style='color: green; font-weight: 600;'";
                    }elseif($Status == "Unresolve"){
                        $statusColor = "style='color: red; font-weight: 600;'";
                    }
                    elseif($Status == "Pending"){
                        $statusColor = "style='color: #ef7c21; font-weight: 600;'";
                    }
                    $table .= "<tr class='text-center'>
                        <td>{$formID}</td>
                        <td>{$Type}</td>
                        <td>{$Description}</td>
                        <td><img src='./NonComplyImages/{$FileName}' width='70'></td>
                        <td {$statusColor}>{$Status}</td>
                        <td>{$AuditorName}</td>
                        <td>{$DateCreated}</td>
                    </tr>";
                }
                $table .= "</tbody></table>";
            }

            return $table;

        }



        
    }
?>