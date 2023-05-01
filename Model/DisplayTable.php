<?php

    require_once 'config.php';

    class DisplayTable extends config{

        public function showUsesList(){
            $con = $this->openConnection();
            $sqlQ = $con->query("SELECT * FROM users WHERE isRegistered = 0");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $userID = $row['UserID'];
                    $Username = $row['Username'];
                    $UserType = $row['UserType'];
                    $CompleteName = $row['Firstname']." ".$row['Middlename']." ".$row['Lastname'];
                    $ProfessionID = $row['ProfessionID'];
                    $DateCreated = $row['DateCreated'];
                    echo "<tr>
                            <td>$Username</td>
                            <td>$ProfessionID</td>
                            <td>$UserType</td>
                            <td>$CompleteName</td>
                            <td>$DateCreated</td>
                            <td>
                                <a class='approveUser text-success me-3' style='cursor: pointer;' id='$userID' ><i class='fa-solid fa-thumbs-up'></i></a>
                                <a class='disapproveUser text-danger' style='cursor: pointer;' id='$userID' ><i class='fa-solid fa-thumbs-down'></i></a>
                            </td>
                        </tr>";
                }
            }
        }


        public function roomNonCompliance($RoomInCharge){
            $con = $this->openConnection();
            $sqlQ = $con->query("SELECT * FROM evaluated_form WHERE room_id = '$RoomInCharge' AND `Type`='NonComplying'");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $formID = $row['form_id'];
                    $DateCreated = $row['DateCreated'];
                    $Auditor = $row['AuditorName'];
                    $Status = $row['Status'];
                    $uniqueKey = $row['UnqiueKeyID'];
                    
                    $complyBtn = ($Status != "Resolve") ? "<a href='javascript:void(0)' class='complyThis' id='{$uniqueKey}'>Comply</a>" : "";
                    $statusColor = "";
                    if($Status == "Resolve"){
                        $statusColor = "style='color: green; font-weight: 600;'";
                    }elseif($Status == "Unresolve"){
                        $statusColor = "style='color: red; font-weight: 600;'";
                    }
                    elseif($Status == "Pending"){
                        $statusColor = "style='color: #ef7c21; font-weight: 600;'";
                    }
                    
                    echo "<tr>
                            <td>{$formID}</td>
                            <td>{$DateCreated}</td>
                            <td>{$Auditor}</td>
                            <td {$statusColor}>{$Status}</td>
                            <td><a href='javascript:void(0)' class='showFeedback' id='{$uniqueKey}'>Feedback</a></td>
                            <td>{$complyBtn}</td>
                        </tr>";
                
                }
            }
        }


        public function showFeedbackDetails($id){
            $con = $this->openConnection();
            $sqlQ = $con->query("SELECT * FROM evaluated_form WHERE UnqiueKeyID = '$id'");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $images = $row['FileName'];
                    $Desc = $row['Description'];

                    echo "
                        <img src='./NonComplyImages/{$images}' width='160'><br><br>
                        <textarea rows='10' cols='50' readonly class='form-control'>{$Desc}</textarea>

                    ";
                }
            }
        }

        public function showCompliedFeedback(){
            $con = $this->openConnection();
            $sqlQ = $con->query("SELECT c.ComplyID, c.isViewed, c.SubmitedBy, c.DateCreated AS DateFeedback,ef.Status,ef.DateCreated, COUNT(*) AS TotalSubmitted FROM compliancefeedback as c INNER JOIN evaluated_form AS ef ON ef.UnqiueKeyID = c.ComplyID WHERE c.ComplyID = ef.UnqiueKeyID AND ef.Status = 'Pending' GROUP BY c.ComplyID");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $id = $row['ComplyID'];
                    $DateFeedback = $row['DateFeedback'];
                    $Status = $row['Status'];
                    $DateCreated = $row['DateCreated'];
                    $TotalCount = $row['TotalSubmitted'];
                    $isViewed = $row['isViewed'];

                    $style = $isViewed == 0 ? "style='background-color: rgba(0,0,0,0.8); color: #fff;'" : "";
                    $statusColor = "";
                    if($Status == "Resolve"){
                        $statusColor = "style='color: green; font-weight: 600;'";
                    }elseif($Status == "Unresolve"){
                        $statusColor = "style='color: red; font-weight: 600;'";
                    }
                    elseif($Status == "Pending"){
                        $statusColor = "style='color: #ef7c21; font-weight: 600;'";
                    }
                    echo "<tr {$style}>
                            <td class='text-center'>{$id}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center' {$statusColor}>{$Status}</td>
                            <td class='text-center'>{$TotalCount}</td>
                            <td class='text-center'><a href='javascript:void(0)' class='viewAll' id='{$id}'>View All</a></td>
                          <tr>";
                }
            }
        }

        public function displaySubmittedCompliance($id){
            $con = $this->openConnection();
            $sqlQ = $con->query("SELECT * FROM compliancefeedback WHERE ComplyID='$id' ORDER BY id DESC LIMIT 1");
            if($sqlQ->execute()){
                $sqlUpdateView = $con->prepare("UPDATE compliancefeedback SET isViewed = 1 WHERE ComplyID='$id'");
                $sqlUpdateView->execute();
                while($row = $sqlQ->fetch()){
                    $date = $row['DateCreated'];
                    $SubmitedBy	= $row['SubmitedBy'];
                    $filename = $row['Filename'];
                    $Description = $row['Description'];
                    $ComplyID = $row['ComplyID'];
                    $newDate = date("F d, Y",strtotime($date));
                    echo " <input type='text' class='form-control mb-3' value='{$newDate}' readonly>
                    <input type='text'class='form-control mb-3' value='{$SubmitedBy}' readonly>
                    <img src='SubmittedCompliance/{$filename}' width='180' alt=''>
                    <input value='{$ComplyID}' type='hidden' name='compliedID'>;
                    <textarea cols='30' rows='5' readonly class='form-control mb-3 mt-3'>{$Description}</textarea>
                    <textarea class='mt-3 form-control' name='YourFeedback' id='' cols='30' rows='10' placeholder='Send your feedback...'></textarea>
                    <select class='form-select mt-3' name='Status'>
                        <option value=''>- Select - </option>
                        <option value='Resolve'>Resolve</option>
                        <option value='Unresolve'>Unresolve</option>
                    </select>
                    ";
                }
                
            }
        }

        public function showCompliedFeedbackRESOLVE(){
            $con = $this->openConnection();
            $sqlQ = $con->query("SELECT c.ComplyID, c.SubmitedBy, c.DateCreated AS DateFeedback,ef.Status,ef.DateCreated, COUNT(*) AS TotalSubmitted FROM compliancefeedback as c INNER JOIN evaluated_form AS ef ON ef.UnqiueKeyID = c.ComplyID WHERE c.ComplyID = ef.UnqiueKeyID AND ef.Status='Resolve' GROUP BY c.ComplyID");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $id = $row['ComplyID'];
                    $SubmitedBy = $row['SubmitedBy'];
                    $DateFeedback = $row['DateFeedback'];
                    $Status = $row['Status'];
                    $DateCreated = $row['DateCreated'];
                    $TotalCount = $row['TotalSubmitted'];
                    $statusColor = "";
                    if($Status == "Resolve"){
                        $statusColor = "style='color: green; font-weight: 600;'";
                    }elseif($Status == "Unresolve"){
                        $statusColor = "style='color: red; font-weight: 600;'";
                    }
                    elseif($Status == "Pending"){
                        $statusColor = "style='color: #ef7c21; font-weight: 600;'";
                    }
                    
                    echo "<tr>
                            <td class='text-center'>{$id}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center'>{$SubmitedBy}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center' {$statusColor}>{$Status}</td>
                            <td class='text-center'>{$TotalCount}</td>
                          <tr>";
                }
            }
        }

        public function showCompliedFeedbackUNRESOLVE(){
            $con = $this->openConnection();
            $sqlQ = $con->query("SELECT c.ComplyID, c.SubmitedBy, c.DateCreated AS DateFeedback,ef.Status,ef.DateCreated, COUNT(*) AS TotalSubmitted FROM compliancefeedback as c INNER JOIN evaluated_form AS ef ON ef.UnqiueKeyID = c.ComplyID WHERE c.ComplyID = ef.UnqiueKeyID AND ef.Status='Unresolve' GROUP BY c.ComplyID");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $id = $row['ComplyID'];
                    $SubmitedBy = $row['SubmitedBy'];
                    $DateFeedback = $row['DateFeedback'];
                    $Status = $row['Status'];
                    $DateCreated = $row['DateCreated'];
                    $TotalCount = $row['TotalSubmitted'];
                    $statusColor = "";
                    if($Status == "Resolve"){
                        $statusColor = "style='color: green; font-weight: 600;'";
                    }elseif($Status == "Unresolve"){
                        $statusColor = "style='color: red; font-weight: 600;'";
                    }
                    elseif($Status == "Pending"){
                        $statusColor = "style='color: #ef7c21; font-weight: 600;'";
                    }
                    echo "<tr>
                            <td class='text-center'>{$id}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center'>{$SubmitedBy}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center' {$statusColor}>{$Status}</td>
                            <td class='text-center'>{$TotalCount}</td>
                          <tr>";
                }
            }
        }

        public function showAuditHistory($id){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM evaluated_form WHERE room_id = '$id'");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $type = $row['Type'];
                    $desc = $row['Description'];
                    $status = $row['Status'];
                    $auditor = $row['AuditorName'];
                    $dateCreated = $row['DateCreated'];

                    echo "<tr class='text-center'>
                            <td>{$type}</td>
                            <td>{$desc}</td>
                            <td>{$status}</td>
                            <td>{$auditor}</td>
                            <td>{$dateCreated}</td>
                        </tr>";


                }
            }
        }

        public function showSubmitSupport($TeacherID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM supportsystem  WHERE TeacherID = '$TeacherID'");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $UniqueKeyID = $row['UniqueKeyID'];
                    $SendTo = $row['SendTo'];
                    $desc = $row['Description'];
                    $status = $row['Status'];   
                    $Filename = $row['Filename'];
                    $DateCreated = $row['DateCreated'];
                    $LastUpdate = $row['LastUpdate'];
                    $UpdatedBy = $row['UpdatedBy'];
                    $fileresult = "";
                    $resultdesc = "";
                    $sqlShow = $con->prepare("SELECT * FROM submitted_supportsystem  WHERE UniqueKeyID = '$UniqueKeyID'");
                    if($sqlShow->execute()){
                        if($sqlShow->rowCount() > 0){

                        }
                        while($row1 = $sqlShow->fetch()){
                            $fileresult =  "<img src='./MaintenanceFeedback/".$row1['Filename']."' width='70'>";
                            $resultdesc = $row1['Description'];
                        }
                    }

                    $statusColor = "";
                    if($status == "Resolve"){
                        $statusColor = "style='color: green; font-weight: 600;'";
                    }elseif($status == "Unresolve"){
                        $statusColor = "style='color: red; font-weight: 600;'";
                    }
                    elseif($status == "Pending"){
                        $statusColor = "style='color: #ef7c21; font-weight: 600;'";
                    }
                    
                    echo "<tr class='text-center'>
                            <td>{$SendTo}</td>
                            <td>{$desc}</td>
                            <td><img src='./SupportSystem/{$Filename}' width='70'></td>
                            <td {$statusColor}>{$status}</td>
                            <td>{$DateCreated}</td>
                            <td>{$resultdesc}</td>
                            <td>{$fileresult}</td>
                            <td>{$LastUpdate}</td>
                            <td>{$UpdatedBy}</td>
                        </tr>";


                }
            }
        }

        public function showAssistance(){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM supportsystem WHERE SendTo = 'Maintenance' AND Status='Pending'");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $uniqueKey   = $row['UniqueKeyID'];
                    $status = $row['Status'];
                    $Description = $row['Description'];
                    $Filename = $row['Filename'];
                    $TeacherName = $row['TeacherName'];
                    $Department = $row['Department'];
                    $DateSubmitted = $row['DateCreated'];
                    $Updated = $row['LastUpdate'];
                    $UpdatedBy = $row['UpdatedBy'];

                    $statusColor = "";
                    if($status == "Resolve"){
                        $statusColor = "style='color: green; font-weight: 600;'";
                    }elseif($status == "Unresolve"){
                        $statusColor = "style='color: red; font-weight: 600;'";
                    }
                    elseif($status == "Pending"){
                        $statusColor = "style='color: #ef7c21; font-weight: 600;'";
                    }

                    echo "<tr class='text-center'>
                            <td {$statusColor}>{$status}</td>
                            <td>{$Description}</td>
                            <td><img src='./SupportSystem/{$Filename}' width='70'></td>
                            <td>{$TeacherName}</td>
                            <td>{$Department}</td>
                            <td>{$DateSubmitted}</td>
                            <td><a href='javascript:void(0)' class='btn btn-success addRemarks' id='{$uniqueKey}'>Add Remarks</a></td>
                        </tr>";
                }
            }
        }

        public function showAssistanceResolve(){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM supportsystem WHERE SendTo = 'Maintenance' AND Status='Resolve'");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $uniqueKey   = $row['UniqueKeyID'];
                    $status = $row['Status'];
                    $Description = $row['Description'];
                    $Filename = $row['Filename'];
                    $TeacherName = $row['TeacherName'];
                    $Department = $row['Department'];
                    $DateSubmitted = $row['DateCreated'];
                    $Updated = $row['LastUpdate'];
                    $UpdatedBy = $row['UpdatedBy'];

                    $statusColor = "";
                    if($status == "Resolve"){
                        $statusColor = "style='color: green; font-weight: 600;'";
                    }elseif($status == "Unresolve"){
                        $statusColor = "style='color: red; font-weight: 600;'";
                    }
                    elseif($status == "Pending"){
                        $statusColor = "style='color: #ef7c21; font-weight: 600;'";
                    }
                    echo "<tr class='text-center'>
                            <td {$statusColor}>{$status}</td>
                            <td>{$Description}</td>
                            <td><img src='./SupportSystem/{$Filename}' width='70'></td>
                            <td>{$TeacherName}</td>
                            <td>{$Department}</td>
                            <td>{$DateSubmitted}</td>
                            <td>{$Updated}</td>
                            <td>{$UpdatedBy}</td>
                        </tr>";
                }
            }
        }

        public function showAssistanceUnresolve(){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM supportsystem WHERE SendTo = 'Maintenance' AND Status='Unresolve'");
            if($sqlQ->execute()){
                while($row = $sqlQ->fetch()){
                    $uniqueKey   = $row['UniqueKeyID'];
                    $status = $row['Status'];
                    $Description = $row['Description'];
                    $Filename = $row['Filename'];
                    $TeacherName = $row['TeacherName'];
                    $Department = $row['Department'];
                    $DateSubmitted = $row['DateCreated'];
                    $Updated = $row['LastUpdate'];
                    $UpdatedBy = $row['UpdatedBy'];
                    $statusColor = "";
                    if($status == "Resolve"){
                        $statusColor = "style='color: green; font-weight: 600;'";
                    }elseif($status == "Unresolve"){
                        $statusColor = "style='color: red; font-weight: 600;'";
                    }
                    elseif($status == "Pending"){
                        $statusColor = "style='color: #ef7c21; font-weight: 600;'";
                    }
                    echo "<tr class='text-center'>
                            <td {$statusColor}>{$status}</td>
                            <td>{$Description}</td>
                            <td><img src='./SupportSystem/{$Filename}' width='70'></td>
                            <td>{$TeacherName}</td>
                            <td>{$Department}</td>
                            <td>{$DateSubmitted}</td>
                            <td>{$Updated}</td>
                            <td>{$UpdatedBy}</td>
                        </tr>";
                }
            }
        }




        public function showCountAllRecommendationKPI(){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM evaluated_form WHERE Type='NonComplying'");
            if($sqlQ->execute()){

                $table = "
                                
                <table class='table table-striped mt-3'><thead class='bg-primary text-center text-white'>
                <tr>
                <th>Form ID</th>
                <th>Status</th>    
                <th>Auditor Name</th>    
                <th>Date Created</th>    
                <th>Lead Time</th>    
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

                    $date1 = date("Y-m-d", strtotime($DateCreated));
                    $date2 = date("Y-m-d");

                    $datetime1 = date_create($date1);
                    $datetime2 = date_create($date2);
                    // Calculates the difference between DateTime objects
                    $interval = date_diff($datetime1, $datetime2);
                    
                    // Printing result in years & months format
                    $finaldate = $interval->format('%a day');

                    $table .= "<tr class='text-center'>
                        <td>{$formID}</td>
                        <td {$statusColor}>{$Status}</td>
                        <td>{$AuditorName}</td>
                        <td>{$DateCreated}</td>
                        <td>{$finaldate}</td>
                    </tr>";
                }
                $table .= "</tbody></table>";
            }

            return $table;

        }




        public function showCountAllRecommendationKPITIME(){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM evaluated_form WHERE Type='NonComplying'");
            if($sqlQ->execute()){

                $table = "
                                
                <table class='table table-striped mt-3'><thead class='bg-primary text-center text-white'>
                <tr>
                <th>Form ID</th>
                <th>Status</th>    
                <th>Auditor Name</th>    
                <th>Date Created</th>    
                <th>Lead Time</th>    
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
                    $date2 = (string)date("Y-m-d H:i:s");
                    
                    $from_time = strtotime($DateCreated); 
                    $to_time = strtotime($date2); 
                    $diff_minutes = round(abs($from_time - $to_time) / 60). " minutes";
                    // Printing result in years & months format

                    $table .= "<tr class='text-center'>
                        <td>{$formID}</td>
                        <td {$statusColor}>{$Status}</td>
                        <td>{$AuditorName}</td>
                        <td>{$DateCreated}</td>
                        <td>{$diff_minutes}</td>
                    </tr>";
                }
                $table .= "</tbody></table>";
            }

            return $table;

        }



    }



?>