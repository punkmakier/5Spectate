
<?php 
    session_start();

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

    <style>
        
        main{
            width: 100%;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        main .card-system{
            margin: 30px;
            padding: 7vw;
            background-color: #d9d9d9;
            text-align: center;
            border-radius: 10px;
            transition: .3s ease-out;

        }
        main .card-system:hover{
            background-color: #2c76df;
            color: #fff;
            cursor: pointer;
        }
        main .card-system i{
            font-size: 6rem;
            margin-bottom: 2rem;
        }
        main .card-system span{
            font-weight: 700;
        }

    </style>
</head>
<body>
<?php include 'GetUserInfo.php'; ?>

    <?php include 'header.php'; ?>

    <main>
        <?php if($_SESSION['UserType'] == "Auditor"):?>
        <div class="card-system" id="auditsys">
            <i class="fa-solid fa-magnifying-glass"></i><br>
            <span>Auditing System</span>
        </div>
        <div class="card-system" id="concernsys">
        <i class="fa-solid fa-comment-dots"></i><br>
            <span>Concern System</span>
        </div>
        <div class="card-system" id="kpisys">
        <i class="fa-solid fa-receipt"></i><br>
            <span>KPI SYSTEM</span>
        </div>
        <div class="card-system" id="usersys">
        <i class="fa-solid fa-users"></i><br>
            <span>Users Management</span>
        </div>
        <?php endif;?>

        <?php if($_SESSION['UserType'] == "Teacher"): ?>
            <div class="card-system" id="revisionSys">
                <i class="fa-solid fa-magnifying-glass"></i><br>
                <span>Revision System</span>
            </div>
            <div class="card-system" id="supportSys">
                <i class="fa-solid fa-magnifying-glass"></i><br>
                <span>Support System</span>
            </div>
        <?php endif; ?>
    </main>


    <script src="js/jquery.v3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        $("#auditsys").click(function(){
            window.location.href="auditsystem.php";
        })
        $("#revisionSys").click(function(){
            window.location.href="revisionsystem.php";
        })
        $("#concernsys").click(function(){
            window.location.href="concernsystem.php";
        })
        $("#kpisys").click(function(){
            
        })
        $("#usersys").click(function(){
            window.location.href="listusers.php";
        })
        
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>