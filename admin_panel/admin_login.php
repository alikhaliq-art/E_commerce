<?php
include('../includes/connect.php');
include('../function/common_functions.php');
@session_start();
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
    <title>Admin Login</title>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center text-info">Admin Login</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6 col-lg-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="my-3 form-outline w-50 m-auto">
                    <label for="admin_name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="admin_name" placeholder=" Enter your username" name="admin_name" autocomplete="off" required="required">
                    </div>
        
                    <div class="my-3 form-outline w-50 m-auto">
                        <label for="admin_password" class="form-label">Password</label>
                        <input class="form-control" type="password" id="admin_password" name="admin_password" required="required" placeholder=" Enter your password" >
                    </div>
        
                    <div class="my-3 form-outline w-50 m-auto">
                    <input type="submit" class="btn btn-info" id="admin_login" name="admin_login" value="Login">
                    </div>
        
                    <div class="my-3 form-outline w-50 m-auto">
                    <p class="small my-2 fw-bold">Don't have an account ? <a href="admin_registeration.php" class="text-danger">Login</a></p>
                    </div>
        
            </form>
            </div>
            <div class="col-md-6 col-lg-6">
                <img src="../images/login.jpg" alt="login" class="img-fluid">
            </div>
        </div>


    </div>
</body>
</html>
<?php
if (isset($_POST['admin_login'])) {
    $admin_name = trim($_POST['admin_name']);
    $admin_password = $_POST['admin_password'];

    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name'";
    $select_result = mysqli_query($_con, $select_query);
    $num_rows = mysqli_num_rows($select_result);
    $row_data = mysqli_fetch_assoc($select_result);
    
    if ($num_rows > 0) {
        $_SESSION['admin_name']= $admin_name;
        if (md5($admin_password) == $row_data['admin_password']) {
            // echo "<script>alert('Congratulations! you have logged in successfully')</script>";
           if($num_rows == 1) {
            $_SESSION['admin_name']= $admin_name;
            echo "<script>alert('Congratulations! you have logged in successfully')</script>";
            echo "<script>window.open('index.php','_self')</script>";
            } else {
            $_SESSION['admin_name']= $admin_name;
            echo "<script>alert('Congratulations! you have logged in successfully')</script>";
            // echo "<script>window.open('payment.php','_self')</script>"; 
            }  
        } else {
            echo "<script>alert('Your username or password does not match')</script>";
        }
    } else {
        echo "<script>alert('username does not exist.')</script>";
    }
}
?>
