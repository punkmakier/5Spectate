<?php
    session_start();
    require_once 'Components/EvaluationForm.php';
    $component = new EvaluationForm;
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
</head>
<body>
    <?php include 'GetUserInfo.php'; ?>
    <?php include 'header.php'; 
        $roomID = $_GET['roomNum'];
    ?>

   <div class="container mt-5">
        <h3>Evaluation Form</h3>
        <div class="card">
            <div class="card-header">1. <b>Sort/Seiri</b> - Clear all items that are not needed Separate items used everyday from those that are not. </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <b>Materials or Parts</b>
                        <div class="row">
                            <div class="col-8"><p>Are there materials or parts that are not used daily or currently in use present?</p></div>
                            <div class="col-2">
                                <select name="" id="" class="form-select" onchange="getFormID(this,'645745');">
                                    <option value="">- Select -</option>
                                    <option value="Complying">Complying</option>
                                    <option value="NonComplying">Non-complying</option>
                                    <option value="NA">N/A</option>
                                </select>
                            </div>
                            <input type="hidden" id="645745_saveFormIdSelected">
                            <div class="col text-center">
                                <a type="button" data-bs-toggle="modal" data-bs-target="#ComplyModal" id="645745_AddComply" style="display:none;"><i class="fa-solid fa-circle-plus" style="font-size: 2rem;"></i></a>
                                <a type="button" id="645745_Save" style="display:none;" onclick="saveItem('645745','<?php echo $roomID ?>')"><i class="fa-solid fa-save text-success" style="font-size: 2rem;"></i></a>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <?php
                    $component->evaluationCard('215625',$roomID);
                    $component->evaluationCard('6574565',$roomID);
                    $component->evaluationCard('97845',$roomID);
                    $component->evaluationCard('56756',$roomID);

                ?>
                
            </div>
        </div>
   </div>


    <!-- Modal -->
<div class="modal fade" id="ComplyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="NonComplyForm" enctype="multipart/form-data" method="POST">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Choose  <input name="formItemID" type="text" id="formItemID"><input name="roomNum" type="text" value="<?php echo $_GET['roomNum']; ?>"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <textarea class="form-control mb-3" name="Description" id="" cols="30" rows="10"></textarea>
            <input name="filename" type="file" class="form-control">
            <input name="typeComply" type="text" class="form-control" id="typeComply">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>




    <script src="js/jquery.v3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    

    <script>
        function getFormID(selected,formID){
            if(selected.value == "NonComplying"){
                $("#"+formID+"_AddComply").show();
                $("#"+formID+"_Save").hide();
                $("#formItemID").val(formID)
                $("#typeComply").val(selected.value)
            }
            else if(selected.value == "Complying"){
                $("#"+formID+"_Save").show();
                $("#"+formID+"_saveFormIdSelected").val("Complying")
                $("#"+formID+"_AddComply").hide();
            }
            else if(selected.value == "NA"){
                $("#"+formID+"_saveFormIdSelected").val("NA")
                $("#"+formID+"_Save").show();
                $("#"+formID+"_AddComply").hide();
            }else{
                $("#"+formID+"_AddComply").hide();
                $("#"+formID+"_Save").hide();
            }
            
        }

        function saveItem(formID, roomID){
            var selected = $("#"+formID+"_saveFormIdSelected").val();
            alert(formID+" "+roomID+" "+selected)
            $.ajax({
                type: "POST",
                url: "Controller/SubmitFormID.php",
                data: {FormID : formID, RoomID : roomID, Type : selected},
                success: function(response){
                    if(response == "Success"){
                        sweetAlert2('success','Success')
                    }else{
                        sweetAlert2('error','You have already evaluated this')
                    }
                }
            })
        }

        $("#NonComplyForm").on("submit", function(event){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "Controller/SubmitFormIDNonComply.php",
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                success: function(response){
                    if(response == "Success"){
                        sweetAlert2('success','Success')
                    }else{
                        sweetAlert2('error','You have already evaluated this')
                    }
                }
            })
        })
    </script>

    <script>
        function sweetAlert2(iconText,textDesc){
            Swal.fire({
            icon: iconText,
            title: textDesc
            })
        }

    </script>
  

</body>
</html>