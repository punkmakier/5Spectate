
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
    <title>User List</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="css/fontawesome/brands.min.css">
    <link rel="stylesheet" href="css/fontawesome/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>
<body>
<?php include 'GetUserInfo.php'; ?>

    <?php include 'header.php'; ?>

    <div class="container">
    <button class="btn btn-primary mt-5" style="width: 8vw;" onclick="window.history.back()"><i class="fa-solid fa-arrow-left-long me-3"></i> Back</button>

        <h3 class="mt-5 mb-5">List of Users</h5>
       <table class="table table-striped" id="thisTable">
            <thead class="bg-primary text-white">
                <tr>
                    <td>Username</td>
                    <td>Profession ID</td>
                    <td>User Type</td>
                    <td>Complete Name</td>
                    <td>Date Registered</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php $display->showUsesList(); ?>
            </tbody>
       </table>
    </div>
       


    <script src="js/jquery.v3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    
    <script>
        $(document).ready(function(){
            $("#thisTable").DataTable();
        })


        $(".approveUser").click(function(){
            var userid = $(this).attr("id");
            Swal.fire({
            title: 'Confirmation Needed',
            text: "Are you sure do you want to approve this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "Controller/UpdateIsRegistered.php",
                    data: {UserID : userid},
                    success: function(response){
                        Swal.fire({
                        title: 'Success',
                        text: "You have successfully approved the user",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                        })
                    }
                })
            }
            })
        })
    </script>
</body>
</html>