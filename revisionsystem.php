
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

</head>
<body>
<?php include 'GetUserInfo.php'; ?>

    <?php include 'header.php'; ?>
    <?php $roomInCharge = $userinfo->showRoomInCharge($UserID); ?>

    <main>
       <div class="container mt-5">
        <button class="btn btn-primary mb-5" style="width: 20vw;" onclick="window.history.back()"><i class="fa-solid fa-arrow-left-long me-3"></i> Back</button>
        <table class="table table-striped mt-5 " id="thisTable1">
            <thead class="text-white fw-bold text-center bg-primary ">
                <tr>
                    <td>Non Compliance ID</td>
                    <td>Date Issued</td>
                    <td>Auditor</td>
                    <td>Status</td>
                    <td>Remarks</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php  $display->roomNonCompliance($roomInCharge);?>
            </tbody>
        </table>
       </div>
       
    </main>

        <!-- Modal -->
<div class="modal fade" id="showFeedBackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remarks</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center" id='showDetailsByID'>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


       <!-- Modal -->
       <div class="modal fade" id="complyModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Comply</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="submitComplyForm" enctype="multipart/form-data">
      <div class="modal-body text-center" id='showDetailsByID'>
        <label for="">Remarks</label>
        <textarea id="" cols="30" rows="10" class="form-control" name="Desc"></textarea>
        <input type="file" class='form-control mt-3' name="filename">
        <input type="hidden" id="complyID" name="ComplyID">
        <input name="cname" type="hidden" value="<?php echo $userinfo->showFirstname($UserID)." ".$userinfo->showLastname($UserID); ?>">
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
        $(document).ready(function() {
          $("#thisTable1").DataTable();

            $('.showFeedback').click(function(){
                var itemId = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "Controller/ShowFeedback.php",
                    data: {itemId: itemId},
                    success: function(response){
                        $("#showDetailsByID").html(response)
                    }
                })
                $("#showFeedBackModal").modal('show');
            })

            $(".complyThis").click(function() {
                var itemId = $(this).attr('id');
                $("#complyID").val(itemId);
                $("#complyModel").modal('show');

            })

            $("#submitComplyForm").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                type: "POST",
                url: "Controller/SubmitComplySection.php",
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                success: function(response){
                    if(response == "Success"){
                        Swal.fire(
                        'Success',
                        'You have successfully submitted a feedback',
                        'success'
                        )
                        Swal.fire({
                        title: 'Success',
                        text: "You have successfully submitted a feedback",
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
                    }else{
                        Swal.fire(
                        'Failed',
                        'Something went wrong...',
                        'error'
                        )
                    }
                }
            })
            })
        })
    </script>
</body>
</html>