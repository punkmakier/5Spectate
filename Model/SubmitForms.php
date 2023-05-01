<?php 
    require_once 'config.php';

    class SubmitForms extends config{

        public function submitSaveForm($formID,$roomID,$Type,$AudName){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM evaluated_form WHERE form_id = '$formID' AND room_id = '$roomID' AND Status = 'Pending'");
            if($sqlQ->execute()){
                if($sqlQ->rowCount() > 0){
                    return false;
                }else{
                    $sqlinsert = $con->prepare("INSERT INTO evaluated_form (`form_id`,`room_id`,`Type`,`AuditorName`) VALUES ('$formID', '$roomID', '$Type','$AudName')");
                    if($sqlinsert->execute()){
                        return true;
                    }
                }
            }
        }


        public function submitSaveFormNonComply($uniqueID,$formID,$roomID,$Type,$Desc,$Filename,$auditor){

            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM evaluated_form WHERE form_id = '$formID' AND room_id = '$roomID' AND Status = 'Pending'");
            if($sqlQ->execute()){
                if($sqlQ->rowCount() > 0){
                    return false;
                }else{
                    $sqlinsert = $con->prepare("INSERT INTO evaluated_form (`UnqiueKeyID`,`form_id`,`room_id`,`Type`,`Description`,`FileName`,`AuditorName`) VALUES ('$uniqueID','$formID', '$roomID', '$Type','$Desc','$Filename','$auditor')");
                    if($sqlinsert->execute()){
                        return true;
                    }
                }
            }
        }
    }