<?php 
    include_once("../../connection/connect.php");

if(isset($_POST['submit'])){
    $user_email = $_POST['email']; // Corrected variable name
    $user_password = $_POST['password']; // Corrected variable name
    $type = $_POST['type']; // Corrected variable name

    if(!empty($user_email) && !empty($user_password) && !is_numeric($user_email))
    {
        print_r($user_email);
        // Hash the password entered by the user
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM `user_table` WHERE user_email = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);

            // Verify hashed password
            if(password_verify($user_password, $user_data['user_password']) && $user_data['user_type'] === $type)
            {
                header("location: ../$type/home.php");
                exit;
            }
        }
        echo "<script>alert('Wrong Username or Password')</script>";
    }
    else {
        echo "<script>alert('Wrong Username or Password')</script>";
    }
}


?>