
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARJ Facility Audit</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="css/fontawesome/brands.min.css">
    <link rel="stylesheet" href="css/fontawesome/all.min.css">
    <link rel="stylesheet" href="css/index_style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
   <div class="overlay"></div>

   <div class="loginpanel" style="height: auto; padding-bottom: 30px;">
        <div class="header"><i class="fa-solid fa-clipboard"></i> MARJ FACILITY AUDIT</div>

        <div class="row me-3">
            <div class="col text-end p-3">
                <a href="index.php" style="color: #fff;">LOGIN</a>
            </div>
        </div>
        <div class="login">
            <span>REGISTER</span>
            <form class="mt-2" id="registerAccount">
                <div class="">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input name="Username" type="text" class="form-control" placeholder="Enter your username..." required>
                </div>
                <div class="">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="Password" type="password" class="form-control" placeholder="Enter your password..." required>
                </div>
                <div class="">
                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                    <input name="ConfirmPass"type="password" class="form-control" placeholder="Enter your confirm password..." required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Login as:</label>
                    <select class="form-select" aria-label="Default select example" name="UserType" id="ifTeacher" required>
                        <option selected>- Select -</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Auditor">Auditor</option>
                    </select>
                </div>
                <div class="mb-3" style="display: none;" id="roomIncharge">
                    <label for="exampleInputPassword1" class="form-label">Room In Charge</label>
                    <select class="form-select" aria-label="Default select example" name="roomIncharge" id="" required>
                        <option selected>- Select -</option>
                        <option value="PhysicsDept">Physics Department</option>
                        <option value="FacultyRoom">Faculty Room</option>
                        <option value="ChemEngDept">Chemical Engineering Department</option>    
                        <option value="IndEngDept">Industrial Engineering Department</option>
                    </select>
                </div>
                <div class="mx-auto text-center">
                    <button type="submit" class="btn btn-success mb-5 mx-auto w-75">Sign Up</button>
                </div>
            </form>
            <div class="footer">
                <a href="">HELP</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="">Terms & Conditions</a>
            </div>
        </div>
   </div>

    <script src="js/jquery.v3.6.1.js"></script>

    <script>
        $(document).ready(function(){
            $("#ifTeacher").on("change", function(){
                if($(this).val() == "Teacher"){
                    $("#roomIncharge").show();
                }else{
                    $("#roomIncharge").hide();
                }
            })
            $("#registerAccount").on("submit", function(e){
                e.preventDefault();
                let formData = $("#registerAccount").serialize();
                $.ajax({
                    type: "POST",
                    url: "Controller/UserRegistration.php",
                    data: formData,
                    success: function(response){
                        if(response == "Success"){
                            Swal.fire({
                            title: 'Successfully Register',
                            text: "Congratulations! You have successfully registered. You can now login to your account",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "index.php";
                            }
                            })
                        }
                        else if(response == "DoNotMatch"){
                            Swal.fire(
                            'Failed',
                            'Password and confirm password did not match.',
                            'error'
                            )
                        }
                        else if(response == "Short"){
                            Swal.fire(
                            'Failed',
                            'Password should not be less than 4 characters long.',
                            'error'
                            )
                        }else{
                            Swal.fire(
                            'Failed',
                            'Something went wrong, please try again.',
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