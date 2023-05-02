<header>
        <div>
            <i class="fa-regular fa-clipboard"></i>
            5Spectate
        </div>
        <div>
            <i class="fa-regular fa-circle-user" style="display: inline-block;"></i>
            <div class="dropdown" style="display: inline-block;">
            <a style="text-decoration: none; color: #fff; font-size: 1.5rem;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $userinfo->showUsername($UserID) ;?> | <?php echo $userinfo->showUserType($UserID) ;?> 
            </a>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AccountSettings">Account Settings</a></li>
                <li><a class="dropdown-item" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePassModal">Change Password</a></li>
                <li><a class="dropdown-item" href="Controller/Logout.php">Logout</a></li>
            </ul>
            </div>
        </div>
    </header>



<!-- Account Settings -->
<div class="modal fade" id="AccountSettings" tabindex="-1" aria-labelledby="AccountSettingsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AccountSettingsLabel">Account Settings</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="UpdateAccountForm">
            <input name="UserID" type="hidden" value="<?php echo $UserID; ?>">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" value="<?php echo $userinfo->showUsername($UserID) ;?>" readonly>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">User Type</label>
                    <input type="text" class="form-control" value="<?php echo $userinfo->showUserType($UserID) ;?>" readonly>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Profession ID</label>
                    <input name="ProfessionID" type="text" class="form-control" value="<?php echo $userinfo->showProfessionID($UserID) ;?>">
                </div>
            </div>
           
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                    <input name="Firstname" type="text" class="form-control" value="<?php echo $userinfo->showFirstname($UserID) ;?>">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Middle Name</label>
                    <input name="Middlename" type="text" class="form-control" value="<?php echo $userinfo->showMiddlename($UserID) ;?>">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Last Name</label>
                    <input name="Lastname" type="text" class="form-control" value="<?php echo $userinfo->showLastname($UserID) ;?>">
                </div>
            </div>
        </div>
        <?php if($_SESSION['UserType'] != "Maintenance"): ?>
        <?php $auditor =  $_SESSION['UserType'] == "Auditor" ? "style='display: none;'" : ""; ?>
        <div class="row" <?php echo $auditor; ?> >
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Department</label>
                    <input name="ProfessionID" readonly type="text" class="form-control" value="<?php echo $userinfo->showRoomInChargeText($UserID) ;?>">
                </div>
            </div>
            
        </div>
        <?php endif;?>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>





<!-- Account Settings -->
<div class="modal fade" id="changePassModal" tabindex="-1" aria-labelledby="AccountSettingsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AccountSettingsLabel">Change Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="changePassAccount">
            <input name="UserID" type="hidden" value="<?php echo $UserID; ?>">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Enter last password</label>
                    <input name="oldPass" type="password" class="form-control" required>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">New Password</label>
                    <input name="newPass" type="password" class="form-control" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Confirm new password</label>
                    <input name="connewPass" type="password" class="form-control" required>
                </div>
            </div>
            
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>