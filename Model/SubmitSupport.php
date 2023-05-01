<?php 
    require_once 'config.php';

    class SubmitSupport extends config{

        public function submitSupportSys($uniqkeyID,$maintenance,$Description,$final_new_name,$TeacherName,$TeacherID,$Department){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("INSERT INTO supportsystem (`UniqueKeyID`,`SendTo`,`Description`,`Filename`,`TeacherName`,`TeacherID`,`Department`)
            VALUES ('$uniqkeyID','$maintenance','$Description','$final_new_name','$TeacherName','$TeacherID','$Department')");
            if($sqlQ->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function submitMaintenance($fname,$description,$status,$final_new_name,$UniqueKey){
            $con = $this->openConnection();
            $sqlQInsert = $con->prepare("INSERT INTO submitted_supportsystem (`Description`,`Filename`,`UniqueKeyID`) VALUES('$description','$final_new_name','$UniqueKey')");
            if($sqlQInsert->execute()){
                $sqlUpdate = $con->prepare("UPDATE supportsystem SET `UpdatedBy`='$fname', `Status`='$status', LastUpdate = now() WHERE UniqueKeyID='$UniqueKey'");
                if($sqlUpdate->execute()){
                    return true;
                }else{
                    return false;
                }
            }
        }

    }

?>