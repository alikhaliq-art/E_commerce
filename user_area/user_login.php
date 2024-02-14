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

    <title>Login Form</title>
</head>
<body class="bg-light">
    <div class="container">
           <h1 class="text-center my-3">User Login</h1>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="my-3 form-outline w-50 m-auto">
            <label for="user_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="user_username" placeholder=" Enter your username" name="user_username" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="user_password" class="form-label">Password</label>
                <input class="form-control" type="password" id="user_password" name="user_password" required="required" placeholder=" Enter your password" >
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <input type="submit" class="btn btn-info" id="user_login" name="user_login" value="Login">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <p class="small my-2 fw-bold">Don't have an account ? <a href="user_registeration.php" class="text-danger"> Register</a></p>
            </div>

    </form>
    </div>
</body>
</html>
<?php
if (isset($_POST['user_login'])) {
    $user_username = trim($_POST['user_username']);
    $user_password = $_POST['user_password'];
    $user_ip = getIPAddress();

    $select_query = "SELECT * FROM `user_table` WHERE user_username='$user_username'";
    $select_result = mysqli_query($_con, $select_query);
    $num_rows = mysqli_num_rows($select_result);
    $row_data = mysqli_fetch_assoc($select_result);

    $select_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $cart_result = mysqli_query($_con, $select_cart);
    $num_rows_cart = mysqli_num_rows($cart_result);
    
    if ($num_rows > 0) {
        $_SESSION['user_username']= $user_username;
        if (md5($user_password) == $row_data['user_password']) {
            // echo "<script>alert('Congratulations! you have logged in successfully')</script>";
           if($num_rows == 1 and $num_rows_cart==0 ) {
            $_SESSION['user_username']= $user_username;
            echo "<script>alert('Congratulations! you have logged in successfully')</script>";
            echo "<script>window.open('profile.php','_self')</script>";
            } else {
            $_SESSION['user_username']= $user_username;
            echo "<script>alert('Congratulations! you have logged in successfully')</script>";
            echo "<script>window.open('payment.php','_self')</script>"; 
            }  
        } else {
            echo "<script>alert('Your username or password does not match')</script>";
        }
    } else {
        echo "<script>alert('Username does not exist.')</script>";
    }
}
?>

