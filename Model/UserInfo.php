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
        public function showUserID($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT UserID FROM users WHERE UserID = '$UserID'");
            if($sqlQ->execute()){
                $res = $sqlQ->fetch();
                return $res['UserID'];
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
        public function showRoomInChargeText($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT RoomInCharge FROM users WHERE UserID = '$UserID'");
            if($sqlQ->execute()){
                $res = $sqlQ->fetch();
                if($res['RoomInCharge'] == "PhysicsDept"){
                    $room = "Physics Department";
                }elseif($res['RoomInCharge'] == "FacultyRoom"){
                    $room = "Faculty Room";
                }elseif($res['RoomInCharge'] == "ChemEngDept"){
                    $room = "Chemical Engineering Department";
                }elseif($res['RoomInCharge'] == "IndEngDept"){
                    $room = "Industrial Engineering Department";
                }
                return $room;
            }
        }
        public function showRoomInCharge($UserID){
            $con = $this->openConnection();
            $sqlQ = $con->prepare("SELECT RoomInCharge FROM users WHERE UserID = '$UserID'");
            if($sqlQ->execute()){
                $res = $sqlQ->fetch();

                return $res['RoomInCharge'];
            }
        }
        
    }



?>