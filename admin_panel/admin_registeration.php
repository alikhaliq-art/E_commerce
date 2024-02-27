<?php
include('../includes/connect.php');
include('../function/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
    <title>Admin Registeration</title>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center text-info">Admin Registeration</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6 col-lg-6">
                <img src="../images/register.jpg" alt="registeration" class="img-fluid">
            </div>
            <div class="col-md-6 col-lg-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="my-3 form-outline w-50 m-auto">
                    <label for="admin_name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="admin_name" placeholder=" Enter your username" name="admin_name" autocomplete="off" required="required">
                    </div>
        
                    <div class="my-3 form-outline w-50 m-auto">
                    <label for="admin_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="admin_email" placeholder=" Enter your Email" name="admin_email" autocomplete="off" required="required">
                    </div>
        
                    <div class="my-3 form-outline w-50 m-auto">
                        <label for="admin_password" class="form-label">Password</label>
                        <input class="form-control" type="password" id="admin_password" name="admin_password" required="required" placeholder=" Enter your password" >
                    </div>
        
                    <div class="my-3 form-outline w-50 m-auto">
                    <label for="admin_conf_password" class="form-label">Confirm Passwod</label>
                    <input type="password" class="form-control" id="admin_conf_password" placeholder="Confirm Password" name="admin_conf_password" required="required">
                    </div>
        
                    <div class="my-3 form-outline w-50 m-auto">
                    <input type="submit" class="btn btn-info" id="admin_register" name="admin_register" value="Register">
                    </div>
        
                    <div class="my-3 form-outline w-50 m-auto">
                    <p class="small my-2 fw-bold">Already have an account ? <a href="admin_login.php" class="text-danger"> Login</a></p>
                    </div>
        
            </form>
            </div>
        </div>


    </div>
</body>
</html>
<?php
if (isset($_POST['admin_register'])) {

    $admin_name = trim($_POST['admin_name']);
    $admin_email = trim($_POST['admin_email']);
    $admin_password = $_POST['admin_password'];
    $admin_conf_password = $_POST['admin_conf_password'];

    if (empty($admin_name) || empty($admin_email) || empty($admin_password) || empty($admin_conf_password)) {
        echo "<script>alert('Please fill in all the required fields.')</script>";
        exit;
    }

    $admin_email = filter_var($admin_email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format. Please enter a valid email.')</script>";
        exit;
    }

    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
    $select_result = mysqli_query($_con, $select_query);
    $num_rows = mysqli_num_rows($select_result);
    
    if ($num_rows > 0) {
        echo "<script>alert('Sorry! Your username or email is already exist.')</script>";
    } elseif ($admin_password != $admin_conf_password) {
        echo "<script>alert('Passwords do not match.')</script>";
    } else {
        $hashed_password = md5($admin_password);

        $insert_data = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password) VALUES ('$admin_name', '$admin_email', '$hashed_password')";

        $result = mysqli_query($_con, $insert_data);
        if ($result) {
            echo "<script>alert('Congratulations! You are registered.')</script>";
            echo "<script>window.open('admin_login.php','_self')</script>";
        } else {
            echo "<script>alert('Oops! Something went wrong. Please try again.')</script>";
        }
    }
}
?>