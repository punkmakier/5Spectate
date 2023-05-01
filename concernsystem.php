
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
</head>
<body>
<?php include 'GetUserInfo.php'; ?>

    <?php include 'header.php'; ?>

    <main>
      <div class="container mt-5">
      <button class="btn btn-primary mb-5" style="width: 20vw;" onclick="window.history.back()"><i class="fa-solid fa-arrow-left-long me-3"></i> Back</button>

        <h4>Complied Feedback</h4>
        <ul class="nav nav-pills mb-3 mt-5" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Pendings</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Resolve</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Unresolve</button>
        </li>

        </ul>
        <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <table class="table mt-5">
                <thead class="bg-primary text-center text-white">
                    <tr>
                        <td>Audit Finding ID</td>
                        <td>Date Issued</td>
                        <td>Submitted By</td>
                        <td>Date Submitted</td>
                        <td>Status</td>
                        <td>Attempt Number</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $display->showCompliedFeedback(); ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <table class="table table-striped mt-5">
                <thead class="bg-primary text-center text-white">
                    <tr>
                        <td>Audit Finding ID</td>
                        <td>Date Issued</td>
                        <td>Submitted By</td>
                        <td>Date Submitted</td>
                        <td>Status</td>
                        <td>Attempt Number</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $display->showCompliedFeedbackRESOLVE(); ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
        <table class="table table-striped mt-5">
                <thead class="bg-primary text-center text-white">
                    <tr>
                        <td>Audit Finding ID</td>
                        <td>Date Issued</td>
                        <td>Submitted By</td>
                        <td>Date Submitted</td>
                        <td>Status</td>
                        <td>Attempt Number</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $display->showCompliedFeedbackUNRESOLVE(); ?>
                </tbody>
            </table>
        </div>
        </div>
        
      </div>
    </main>

        <!-- Modal -->
<div class="modal fade" id="viewAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Choose</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="auditorFeedbackForm">
      <div class="modal-body text-center" id="selectedIDModal">
       
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

    <?php include 'footer.php'; ?>


    <script>
        $(document).ready(function() {
            $(".viewAll").click(function(){
                var selected = $(this).attr("id");
                $.ajax({
                    type: "POST",
                    url: "Controller/ViewASelectedComplied.php",
                    data: {SelectedID : selected},
                    success: function(response){
                        $("#selectedIDModal").html(response)
                    }
                })
                $("#viewAll").modal("show")
            })

            $("#auditorFeedbackForm").on("submit", function(event){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "Controller/SubmitFeedbackFromAudit.php",
                    data: new FormData(this),
                    contentType: false,
                    processData:false,
                    cache: false,
                    success: function(response){
                        alert(response)
                        if(response == "Success"){
                            Swal.fire({
                            title: 'Success',
                            text: "Update successfully",
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