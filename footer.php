


<script>
    $(document).ready(function(){

        $("#UpdateAccountForm").on("submit", function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                    type: "POST",
                    url: "Controller/UpdateAccount.php",
                    data: formData,
                    success: function(response){
                        if(response == "Success"){
                            Swal.fire({
                            title: 'Success',
                            text: "Update Account Success",
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
                            'Something went wrong updating your account',
                            'error'
                            )
                        }
                    }
                })
        })


        $("#changePassAccount").on("submit", function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                    type: "POST",
                    url: "Controller/ChangePassword.php",
                    data: formData,
                    success: function(response){
                        if(response == "Success"){
                            Swal.fire({
                            title: 'Success',
                            text: "Update Account Success",
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
                        }else if(response == "DoNotMatch"){
                            Swal.fire(
                            'Failed',
                            'Your new password and confirmation password did not match',
                            'error'
                            )
                        }
                        else if(response == "OldPass"){
                            Swal.fire(
                            'Failed',
                            'Your old password did not match.',
                            'error'
                            )
                        }else if(response == "Short"){
                            Swal.fire(
                            'Failed',
                            'Password should not be less than 4 characters long',
                            'error'
                            )
                        }
                    }
                })
        })
    })
</script>