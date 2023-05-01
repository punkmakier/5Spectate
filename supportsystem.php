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
    <title>Audit System</title>
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

    <?php 
        $TeacherID = $userinfo->showUserID($UserID);
        $Department = $userinfo->showRoomInChargeText($UserID);
    ?>

    <main style="padding: 2rem;">
 
        <div class="container">
            <button class="btn btn-primary" style="width: 8vw;" onclick="window.history.back()"><i class="fa-solid fa-arrow-left-long me-3"></i> Back</button>
            <br><br><button type="button" class="btn btn-success mt-5 mb-5" data-bs-toggle="modal" data-bs-target="#supportSystemModal">Ask Assistance</button>

            <table class="table table-striped mt-5" id="thisTable1">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <td>Send To</td>
                        <td>Description</td>
                        <td>Attachment</td>
                        <td>Status</td>
                        <td>Date Created</td>
                        <td>Update Remarks</td>
                        <td>Updated Image</td>
                        <td>Last Update</td>
                        <td>Updated By</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $display->showSubmitSupport($TeacherID); ?>
                </tbody>
            </table>
        </div>

    </main>

    
    <!-- Modal -->
<div class="modal fade" id="supportSystemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Support System</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="submitSupportForm">
      <div class="modal-body">
        <select name="Maintenance" id="" class="form-select mb-3">
            <option value="Maintenance">Maintenance</option>
        </select>
        <input name="TeacherID" type="hidden    " value="<?php echo $TeacherID; ?>">
        <input name="Department" type="hidden   " value="<?php echo $Department; ?>">
        <input type="hidden" value="<?php echo $userinfo->showFirstname($UserID)." ".$userinfo->showLastname($UserID) ;?>" name="TeacherName">
        <textarea name="Description" id="" cols="30" rows="5" class="form-control"></textarea>
        <input type="file" name="filename" class="mt-3 form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


    <script src="js/jquery.v3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function(){
          $("#thisTable1").DataTable();
            
        })
    </script>

    <script>
         $("#submitSupportForm").on("submit", function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "Controller/SubmitSupportSystem.php",
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                success: function(response){
                    if(response == "Success"){
                        Swal.fire({
                            title: 'Success',
                            text: "You have successfully submitted a support system",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                            })
                    }
                }
            })
        })
    </script>
</body>
</html>