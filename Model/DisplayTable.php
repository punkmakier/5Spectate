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
                    
                    echo "<tr>
                            <td>{$formID}</td>
                            <td>{$DateCreated}</td>
                            <td>{$Auditor}</td>
                            <td>{$Status}</td>
                            <td><a href='javascript:void(0)' class='showFeedback' id='{$uniqueKey}'>Feedback</a></td>
                            <td><a href='javascript:void(0)' class='complyThis' id='{$uniqueKey}'>Comply</a></td>
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
                    $SubmitedBy = $row['SubmitedBy'];
                    $DateFeedback = $row['DateFeedback'];
                    $Status = $row['Status'];
                    $DateCreated = $row['DateCreated'];
                    $TotalCount = $row['TotalSubmitted'];
                    $isViewed = $row['isViewed'];

                    $style = $isViewed == 0 ? "style='background-color: rgba(0,0,0,0.8); color: #fff;'" : "";
                    
                    echo "<tr {$style}>
                            <td class='text-center'>{$id}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center'>{$SubmitedBy}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center'>{$Status}</td>
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
                    
                    echo "<tr>
                            <td class='text-center'>{$id}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center'>{$SubmitedBy}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center'>{$Status}</td>
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
                    
                    echo "<tr>
                            <td class='text-center'>{$id}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center'>{$SubmitedBy}</td>
                            <td class='text-center'>{$DateCreated}</td>
                            <td class='text-center'>{$Status}</td>
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



    }



?>