<?php 
    session_start();
    require_once 'config.php';

    class UserAuth extends config{

        public function registerAccount($Username,$Password,$UserType,$UserID,$roomIncharge){
            $con = $this->openConnection();
            $sqlCheck = $con->query("SELECT `UserID` FROM `users` WHERE `UserID` = '$UserID'");
            if($sqlCheck->execute()){
                if($sqlCheck->rowCount() > 0){
                    return false;
                }else{
                    $sqlQ = $con->prepare("INSERT INTO users (UserID,Username,Password,UserType,RoomInCharge) VALUES('$UserID','$Username','$Password','$UserType','$roomIncharge')");
                    if($sqlQ->execute()){
                        return true;
                    }
                }
            } 
        }

        public function userLogin($Username, $Password){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT `UserID`,`UserType`,`isRegistered` FROM users WHERE Username = '$Username' AND Password = '$Password'");
            if($sqlQ->execute()){
                if($sqlQ->rowCount() > 0){
                    while($row = $sqlQ->fetch()){
                        if($row['isRegistered'] == 0){
                            echo "NotRegistered";
                        }else{
                            $_SESSION['UserID'] = $row['UserID'];
                            $_SESSION['UserType'] = $row['UserType'];
                        }
                        
                    }
                }else{
                    echo "Invalid";
                }
            }
        }



        public function updateAccount($UserID,$Firstname,$Middlename,$Lastname,$ProfessionID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("UPDATE users SET `Firstname` = '$Firstname',`Middlename`='$Middlename', `Lastname`='$Lastname',`ProfessionID` = '$ProfessionID' WHERE `UserID`='$UserID'");
            if($sqlQ->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function userChangePass($UserID,$OldPass,$Pass){
            $con = $this->openConnection();
            $sqlCheck = $con->prepare("SELECT `Password` FROM users WHERE `UserID` = '$UserID'");
            if($sqlCheck->execute()){
                $res = $sqlCheck->fetch();
                if($res['Password'] != $OldPass){
                    echo "OldPass";
                }else{
                    $sqlQ = $con->prepare("UPDATE users SET `Password` = '$Pass' WHERE `UserID`='$UserID'");
                    if($sqlQ->execute()){
                        echo "Success";
                    }else{
                        echo "Invalid";
                    }
                }
            }
        }

        public function updateRegistered($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("UPDATE users SET `isRegistered` = 1 WHERE `UserID`='$UserID'");
            if($sqlQ->execute()){
                return true;
            }else{
                return false;
            }
        }
    }


?>