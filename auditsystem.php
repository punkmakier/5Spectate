<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="css/fontawesome/brands.min.css">
    <link rel="stylesheet" href="css/fontawesome/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    

    <style>

        .classroomlist{
            margin-top: 2rem;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .roomsbtn{
            background-color: #14c4f0;
            color: #fff !important;
            font-weight: 600;
            margin: 5px;
        }
        .roomsbtn:hover{
            color: rgba(255,255,255,0.8) !important;
            background-color: #0e97b9fa;

        }
    </style>
</head>
<body>
    <?php include 'GetUserInfo.php'; ?>
    <?php include 'header.php'; ?>

    <main style="padding: 3rem;">
        <div class="row">
            <div class="col-5">
                <button class="btn btn-primary" style="width: 20vw;" onclick="window.history.back()"><i class="fa-solid fa-arrow-left-long me-3"></i> Back</button>
                <div class="classroomlist">
                    <button id="roomPhysicDept" class="roomsbtn btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Physics Dept</button>
                    <button id="rooomFaculty" class="roomsbtn btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Faculty Room</button>
                    <button id="roomChemEngDept" class="roomsbtn btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Chem Eng'g Department</button>
                    <button id="roomIndEngDept" class="roomsbtn btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Industrial Eng'g Department</button>
                </div>
            </div>
            <div class="col text-end">
                <img src="assets/bg2.jpg" alt="" style="width: 85%;">
            </div>
        </div>
 

    </main>


    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Choose</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <input type="text" id="roomNum">
        <button type="button" class="btn btn-info me-5" id="makeAudit">5s Audit</button> 
        <button type="button" class="btn btn-success">Audit History</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



    <script src="js/jquery.v3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <script>
        $("#roomPhysicDept").click(function(){
            var btnId = $(this).attr("id");
            $("#roomNum").val(btnId);
        })
        $("#rooomFaculty").click(function(){
            var btnId = $(this).attr("id");
            $("#roomNum").val(btnId);
        })
        $("#roomChemEngDept").click(function(){
            var btnId = $(this).attr("id");
            $("#roomNum").val(btnId);
        })
        $("#roomIndEngDept").click(function(){
            var btnId = $(this).attr("id");
            $("#roomNum").val(btnId);
        })

        $("#makeAudit").click(function(){
            var roomNum = $("#roomNum").val();
            window.location.href = "auditingsystem.php?roomNum=" + roomNum;
        })
    </script>

</body>
</html>