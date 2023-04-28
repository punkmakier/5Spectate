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
    }



?>