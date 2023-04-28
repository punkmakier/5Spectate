<?php

    require_once 'config.php';

    class UserInfo extends config{
        
        public function showUsername($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT Username FROM users WHERE UserID = '$UserID'");
            if($sqlQ->execute()){
                $res = $sqlQ->fetch();
                return $res['Username'];
            }
        }
        public function showUserType($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT UserType FROM users WHERE UserID = '$UserID'");
            if($sqlQ->execute()){
                $res = $sqlQ->fetch();
                return $res['UserType'];
            }
        }

        public function showFirstname($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT Firstname FROM users WHERE UserID = '$UserID'");
            if($sqlQ->execute()){
                $res = $sqlQ->fetch();
                return $res['Firstname'];
            }
        }
        public function showMiddlename($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT Middlename FROM users WHERE UserID = '$UserID'");
            if($sqlQ->execute()){
                $res = $sqlQ->fetch();
                return $res['Middlename'];
            }
        }
        public function showLastname($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT Lastname FROM users WHERE UserID = '$UserID'");
            if($sqlQ->execute()){
                $res = $sqlQ->fetch();
                return $res['Lastname'];
            }
        }
        public function showProfessionID($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT ProfessionID FROM users WHERE UserID = '$UserID'");
            if($sqlQ->execute()){
                $res = $sqlQ->fetch();
                return $res['ProfessionID'];
            }
        }
    }



?>