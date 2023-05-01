<?php 
    require_once 'config.php';

    class SubmitNonComplianceFeedback extends config{

        public function submitNonCompliance($id,$desc,$filename){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("INSERT INTO compliancefeedback (`ComplyID`,`Description`,`Filename`) VALUES('$id','$desc','$filename')");
            if($sqlQ->execute()){
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