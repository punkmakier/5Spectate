<?php 
    require_once 'config.php';

    class SubmitForms extends config{

        public function submitSaveForm($formID,$roomID,$Type){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM evaluated_form WHERE form_id = '$formID' AND room_id = '$roomID' AND Status = 'Pending'");
            if($sqlQ->execute()){
                if($sqlQ->rowCount() > 0){
                    return false;
                }else{
                    $sqlinsert = $con->prepare("INSERT INTO evaluated_form (`form_id`,`room_id`,`Type`) VALUES ('$formID', '$roomID', '$Type')");
                    if($sqlinsert->execute()){
                        return true;
                    }
                }
            }
        }


        public function submitSaveFormNonComply($formID,$roomID,$Type,$Desc,$Filename){

            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT * FROM evaluated_form WHERE form_id = '$formID' AND room_id = '$roomID' AND Status = 'Pending'");
            if($sqlQ->execute()){
                if($sqlQ->rowCount() > 0){
                    return false;
                }else{
                    $sqlinsert = $con->prepare("INSERT INTO evaluated_form (`form_id`,`room_id`,`Type`,`Description`,`FileName`) VALUES ('$formID', '$roomID', '$Type','$Desc','$Filename')");
                    if($sqlinsert->execute()){
                        return true;
                    }
                }
            }
        }
    }