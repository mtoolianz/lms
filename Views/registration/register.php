<?php
function getIPAddress() {

    if (!empty($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    } else {
        return 'UNKNOWN';
    }
}
     include_once ("../layouts/header.php") ;
     include_once ("../../connection/connect.php");
?>
<div class="cotainer-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex aliggn-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
        
                <form action="" method="post" enctype="multipart/form-data" class="user_form">
                  
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter Your Username" autocomplete="off" required="required" name="user_username">
                    </div>
                    <div class="mb-3">
                        <label for="createUserEmail" class="form-label">User Type</label>
                       <select name="user_type" id="user_type" required>
                        <option value="choose">Choose</option>
                        <option value="user">User</option>
                        <!-- <option value="admin">Admin</option> -->
                    </select>
                    <br>
                  
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">E-mail</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter Your Email" autocomplete="off" required="required" name="user_email">
                    </div>
       
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter Your Password" autocomplete="off" required="required" name="user_password">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Enter Your Confirm Password" autocomplete="off" required="required" name="conf_user_password">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter Your Address" autocomplete="off" required="required" name="user_address">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contect</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter Your Mobile Number" autocomplete="off" required="required" name="user_contact">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account?<a href="../auth/user_login.php" class="text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php
if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_type = $_POST['user_type'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];


    $select_query = "SELECT * FROM `user_table` WHERE user_name='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    
    if ($rows_count > 0) {
        echo "<script>alert('Username or Email already exists')</script>";
    } elseif ($user_password != $conf_user_password) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {


        $insert_query = "INSERT INTO `user_table` (user_name, user_type, user_email, user_password, user_address, user_contact) 
                         VALUES ('$user_username','$user_type' ,'$user_email','$hash_password', '$user_address', '$user_contact')";
        
        if (mysqli_query($con, $insert_query)) {
            echo "<script>alert('User registered successfully')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
        }
    }
}
      
     
?>