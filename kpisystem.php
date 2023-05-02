
<?php 
    session_start();
    require_once 'Model/DisplayTable.php';
    $display = new DisplayTable;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="css/fontawesome/brands.min.css">
    <link rel="stylesheet" href="css/fontawesome/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        #btnCustom{
            background-color: grey;
            width: 25vw;
            margin: 0 auto;
            margin-top: 30px;
            padding: 10px 50px;
            color: #fff;
            border-radius: 20px;
            cursor: pointer;
            transition: .3s ease-in-out;
        }
        #btnCustom:hover{
            background-color: #a29fa3;

        }
    </style>
</head>
<body>
<?php include 'GetUserInfo.php'; ?>

    <?php include 'header.php'; ?>
    <?php $roomInCharge = $userinfo->showRoomInCharge($UserID); ?>

    <main>
       <div class="container mt-5">
        <button class="btn btn-primary mb-5" style="width: 20vw;" onclick="window.history.back()"><i class="fa-solid fa-arrow-left-long me-3"></i> Back</button>

        <div style="width: 100%; text-align: center;">
            <div id="btnCustom" type="button" data-bs-toggle="modal" data-bs-target="#showCountAll">Count of Issues Found</div>
            <div id="btnCustom" type="button" data-bs-toggle="modal" data-bs-target="#showCountAllRecommendationTIME">Lead Time of the Recommendation Implementation</div>
        </div>
       </div>
       
    </main>

        <!-- Modal -->
        <?php include 'countissue.php';?>


    <script src="js/jquery.v3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function(){
            $("#showCountChange").on("change", function(){
                var count = $(this).val();
                $.ajax({
                type: "POST",
                url: "Controller/ShowAllResultKPI.php",
                data: {SelectedCount : count, Action : "ThisSelected"},
                success: function(response){
                    $("#showCountAllRes").html(response)
                }
                })
            })
        })
    </script>
</body>
</html>