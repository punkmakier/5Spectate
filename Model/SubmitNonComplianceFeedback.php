<?php 
    require_once 'config.php';

    class SubmitNonComplianceFeedback extends config{

        public function submitNonCompliance($id,$desc,$filename,$submittedby){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("INSERT INTO compliancefeedback (`ComplyID`,`Description`,`Filename`,`SubmitedBy`) VALUES('$id','$desc','$filename','$submittedby')");
            if($sqlQ->execute()){
                $sqlQUpdate = $con->prepare("UPDATE evaluated_form SET `Status` = 'Pending' WHERE UnqiueKeyID='$id'");
                $sqlQUpdate->execute();
                $sqlQUpdate1 = $con->prepare("UPDATE compliancefeedback SET `isViewed` = 0 WHERE ComplyID='$id'");
                $sqlQUpdate1->execute();
                return true;
            }else{
                return false;
            }
        }


        public function submitFeedbackAudit($id,$feedback,$status){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("UPDATE evaluated_form SET `Status` = '$status' WHERE `UnqiueKeyID`='$id'");
            if($sqlQ->execute()){
                $sqlQUpdate = $con->prepare("UPDATE compliancefeedback SET `Feedback` = '$feedback' WHERE `ComplyID`='$id'");
                if($sqlQUpdate->execute()){
                    return true;
                }else{
                    return false;
                }
                return false;
            }
        }
        
    }
?>