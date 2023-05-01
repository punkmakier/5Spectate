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
        $roomID = $_GET['room'];
        $room = "";
        if($roomID == "PhysicsDept"){
            $room = "Physics Department";
        }elseif($roomID == "FacultyRoom"){
            $room = "Faculty Room";
        }elseif($roomID == "ChemEngDept"){
            $room = "Chemical Engineering Department";
        }elseif($roomID == "IndEngDept"){
            $room = "Industrial Engineering Department";
        }

        $auditorName = $userinfo->showFirstname($UserID)." ".$userinfo->showLastname($UserID);
    ?>

   <div class="container">
   <button class="btn btn-primary mt-5" style="width: 15vw;" onclick="window.history.back()"><i class="fa-solid fa-arrow-left-long me-3"></i> Back</button>
    <input type="hidden" id="audname" value="<?php echo $auditorName; ?>">
        <h3 class="mt-5">Evaluation Form - <?php echo $room; ?></h3>
        <div class="card">
            <div class="card-header">1. <b>Sort/Seiri</b> - Clear all items that are not needed Separate items used everyday from those that are not. </div>
            <div class="card-body">
                <?php
                    $component->evaluationCard('101',$roomID,"Materials or Parts","Are there materials or parts that are not used daily or currently in use present?");
                    $component->evaluationCard('102',$roomID,"Storage Areas","Items in storage are consistent with the storage label.");
                    $component->evaluationCard('103',$roomID,"Trash Cans","container is not overfilled. There is no leftover food that can cause smells. There’s segregation of trash.");
                    $component->evaluationCard('104',$roomID,"Walls","No unnecessary items on walls such as pictures, outdated documents and other nonwork-related documents.");
                    $component->evaluationCard('105',$roomID,"Aisles Corners and Floors","No unneeded items such as equipment, containers etc that can block walk paths");
                ?>
                
            </div>
        </div>
   </div>
   <div class="container">
     <!-- Number 2 -->
        <div class="card m-3">
            <div class="card-header">2. <b>Set in Order/Seiton</b> - Place for Everything, and Everything in its Place. Deals with the orderliness of the workplace.</div>
            <div class="card-body">

                <?php
                    $component->evaluationCard('201',$roomID,"Labels for Documents, Supplies and Storage","Storage areas are present for all materials and are easily accessible. ");
                    $component->evaluationCard('202',$roomID,"Orderly Storage","All items are stored in a fixed place and have their own assigned storage");
                    $component->evaluationCard('203',$roomID,"Display Areas","All boards such as bulletin boards have contents that are clearly and orderly displayed.");
                    $component->evaluationCard('204',$roomID,"Safety Materials","Accessible, active and functioning safety materials such as first aid kits, fire extinguisher etc");
                ?>
                
            </div>
        </div>
   </div>

   <!-- number 3 -->
   <div class="container">
     <!-- SET in ORDER/Seiton -->
        <div class="card m-3">
            <div class="card-header">3. <b>Shine/Seiso</b> - All items are clean and presentable. Maintaining the cleanliness and order of the work area.</div>
            <div class="card-body">

                <?php
                    $component->evaluationCard('301',$roomID,"Floor ","No trash, no spills or damage. ");
                    $component->evaluationCard('302',$roomID,"Lighting"," sufficient lighting present in all work areas.");
                    $component->evaluationCard('303',$roomID,"Desk, Window, Table, and Shelves","No trashes, dusts, dirt, spilled liquid, etc.");
                    $component->evaluationCard('304',$roomID,"Labels, Signs, and Displays","Presentable and readable.");
                    $component->evaluationCard('305',$roomID,"Appliances and Equipment","All appliances and equipment are in good working condition and free of hazards");
                ?>
                
            </div>
        </div>
   </div>

   <!-- number 4 -->
   <div class="container">
     <!-- SET in ORDER/Seiton -->
        <div class="card m-3">
            <div class="card-header">4. <b>Standardize/Seiketsu</b> - Procedures and Standards are created. Maintaining and monitoring the first 3S. Making the standards and rules into a habit. </div>
            <div class="card-body">

                <?php
                    $component->evaluationCard('401',$roomID,"Ventilation","Air is odorless, no smoke and no distracting or irritating odors.");
                    $component->evaluationCard('402',$roomID,"Grooming"," Employees wear clean and proper attire in compliance with company grooming policy.");
                    $component->evaluationCard('403',$roomID,"Display of Standards","There are references to standards that are easily visible.");
                    $component->evaluationCard('404',$roomID,"Responsibilities","Everyone knows their responsibilities and roles in 5S");
                ?>
                
            </div>
        </div>
   </div>

   <!-- number 5 -->
   <div class="container">
     <!-- SET in ORDER/Seiton -->
        <div class="card m-3">
            <div class="card-header">5. <b>Standardize/Seiketsu</b> - Be consistent in following the standards. Continuing or maintaining commitment to the 5S.</div>
            <div class="card-body">

                <?php
                    $component->evaluationCard('501',$roomID,"The First Three Steps","Following company standards related to the workplace. Maintenance of the Organization, Orderliness and Cleanliness in the workplace. ");
                    $component->evaluationCard('502',$roomID,"5S Awareness","Employees have attended 5S training and are aware of the 5S principles.");
                    $component->evaluationCard('503',$roomID,"Progress Stories","before and after pictures of workplaces are displayed.");
                    $component->evaluationCard('504',$roomID,"Rewards","Recognition and Rewards are available for employees that are actively upholding 5S standards");
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Submit Compliance Feedback  <input name="formItemID" type="hidden" id="formItemID"><input name="roomNum" type="hidden" value="<?php echo $_GET['room']; ?>"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <textarea class="form-control mb-3" name="Description" id="" cols="30" rows="10" placeholder="Enter your feedback here..."></textarea>
            <input name="filename" type="file" class="form-control">
            <input name="typeComply" type="hidden" class="form-control" id="typeComply">
            <input name="AuditorName" type="hidden" class="form-control" value="<?php echo $userinfo->showFirstname($UserID)." ".$userinfo->showLastname($UserID); ?>">
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
            var audname = $("#audname").val();
            $.ajax({
                type: "POST",
                url: "Controller/SubmitFormID.php",
                data: {FormID : formID, RoomID : roomID, Type : selected, AudName : audname},
                success: function(response){
                    if(response == "Success"){
                        $("#"+formID+"selection").hide()
                        $("#"+formID+"_evaluated").show()
                        $("#"+formID+"_Save").hide()
                        sweetAlert2('success','Success')
                        
                    }else{
                        sweetAlert2('error','You have already evaluated this')
                    }
                }
            })
        }



        $("#NonComplyForm").on("submit", function(event){
            var formID = $("#formItemID").val();
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
                        $("#"+formID+"selection").hide()
                        $("#"+formID+"_evaluated").show()
                        $("#"+formID+"_AddComply").hide()
                        sweetAlert2('success','Success')
                        $("#ComplyModal").modal('hide')
                        $('#NonComplyForm')[0].reset();
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