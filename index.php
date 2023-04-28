
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

   <div class="loginpanel">
        <div class="header"><i class="fa-solid fa-clipboard"></i> MARJ FACILITY AUDIT</div>

        <div class="row me-3">
            <div class="col text-end p-3">
                <a href="register.php" style="color: #fff;">REGISTER</a>
            </div>
        </div>
        <div class="login">
            <span>LOGIN</span>
            <form class="mt-5" id="userLogin">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input name="Username" type="text" class="form-control" placeholder="Enter your username...">
                </div>
                <div class="">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="Password" type="password" class="form-control" placeholder="Enter your password...">
                    <div id="emailHelp" class="form-text text-end"><a href="">Forgot Password</a></div>

                </div>

                <button type="submit" class="btn btn-success mb-5">Submit</button>
            </form>
            <div class="footer">
                <a href="">HELP</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="">Terms & Conditions</a>
            </div>
        </div>
   </div>

    <script src="js/jquery.v3.6.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#userLogin").on("submit", function(e){
                e.preventDefault();
                let formData = $("#userLogin").serialize();
                $.ajax({
                    type: "POST",
                    url: "Controller/UserLogin.php",
                    data: formData,
                    success: function(response){
                        if(response == "NotRegistered"){
                            Swal.fire(
                            'Login Failed',
                            'Your account is not yet approve. ',
                            'error'
                            )
                        }
                        else if(response == "Invalid"){
                            Swal.fire(
                            'Login Failed',
                            'Username or password is incorrect',
                            'error'
                            )
                        }else{
                            window.location.href="dashboard.php";
                        }
                    }
                })
            })
        })
    </script>
</body>
</html>