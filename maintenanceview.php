

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

 

    <main style="padding: 2rem;">
 
        <div class="container">
            <button class="btn btn-primary" style="width: 8vw;" onclick="window.history.back()"><i class="fa-solid fa-arrow-left-long me-3"></i> Back</button>
           

            <ul class="nav nav-pills mb-3 mt-5" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Pending</button>
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
                <table class="table table-striped mt-5" id="thisTable">
                    <thead class="bg-primary text-center text-white">
                        <tr>
                            <td>Status</td>
                            <td>Description</td>
                            <td>Filename</td>
                            <td>Teacher Name</td> 
                            <td>Department</td> 
                            <td>Date Submitted</td> 
                            <td>Action</td> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php $display->showAssistance(); ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <table class="table table-striped mt-5 w-100" id="thisTable3">
                        <thead class="bg-primary text-center text-white">
                            <tr>
                                <td>Status</td>
                                <td>Description</td>
                                <td>Filename</td>
                                <td>Teacher Name</td> 
                                <td>Department</td> 
                                <td>Date Submitted</td> 
                                <td>Last Update</td> 
                                <td>Updated By</td> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $display->showAssistanceResolve(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <table class="table table-striped mt-5 w-100" id="thisTable2">
                        <thead class="bg-primary text-center text-white">
                            <tr>
                                <td>Status</td>
                                <td>Description</td>
                                <td>Filename</td>
                                <td>Teacher Name</td> 
                                <td>Department</td> 
                                <td>Date Submitted</td> 
                                <td>Last Update</td> 
                                <td>Updated By</td> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $display->showAssistanceUnresolve(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
    </main>
    

    <div class="modal fade" id="showAddRemarks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Remarks</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="submitAssistanceForm">
      <div class="modal-body">
        <input type="hidden" id='unique' name="uniqueID">
        <input type="hidden" name="completename" value="<?php echo $userinfo->showFirstname($UserID)." ".$userinfo->showLastname($UserID); ?>">
        <select name="status" id="" class='form-select'>
            <option value="">- Select -</option>
            <option value="Resolve">Resolve</option>
            <option value="Unresolve">Unresolve</option>
        </select>
        <textarea name="Description" id="" cols="30" rows="5" placeholder="Enter your remarks here..." class="form-control mt-3"></textarea>
        <input name="filename" type="file" class='form-control mt-3'>
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
        $(".addRemarks").click(function(){
            var id = $(this).attr("id");
            $("#unique").val(id);
            $("#showAddRemarks").modal('show');
        })
    </script>

    <script>
        $(document).ready(function(e){

            

            $("#submitAssistanceForm").on("submit", function(e){
            e.preventDefault();
                 $.ajax({
                    type: "POST",
                    url: "Controller/SubmitMaintenanceFeedback.php",
                    data: new FormData(this),
                    contentType: false,
                    processData:false,
                    cache: false,
                    success: function(response){
                        if(response == "Success"){
                            Swal.fire({
                            title: 'Success',
                            text: "Remarks has been submitted successfully",
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
            
           
        })
    </script>

</body>
</html>