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

    <title>Registeration Form</title>
</head>
<body class="bg-light">
    <div class="container">
           <h1 class="text-center my-3">New Registeration</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="my-3 form-outline w-50 m-auto">
            <label for="user_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="user_username" placeholder=" Enter your username" name="user_username" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="user_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="user_email" placeholder=" Enter your Email" name="user_email" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="user_image" class="form-label">Profile</label>
            <input type="file" class="form-control" id="user_image" name="user_image" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="user_address" class="form-label">Address</label>
                <input class="form-control" type="text" id="user_address" name="user_address" required="required" placeholder=" Enter your address" >
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="user_mobile" class="form-label">Mobile</label>
                <input class="form-control" type="text" id="user_mobile" name="user_mobile" required="required" placeholder=" Enter your mobile number" >
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="user_password" class="form-label">Password</label>
                <input class="form-control" type="password" id="user_password" name="user_password" required="required" placeholder=" Enter your password" >
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="user_conf_password" class="form-label">Confirm Passwod</label>
            <input type="password" class="form-control" id="user_conf_password" placeholder="Confirm Password" name="user_conf_password" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <input type="submit" class="btn btn-info" id="user_register" name="user_register" value="Register">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <p class="small my-2 fw-bold">Already have an account ? <a href="user_login.php" class="text-danger"> Login</a></p>
            </div>

    </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['user_register'])) {

    $user_username = trim($_POST['user_username']);
    $user_email = trim($_POST['user_email']);
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_address = trim($_POST['user_address']);
    $user_mobile = trim($_POST['user_mobile']);
    $user_password = $_POST['user_password'];
    $user_conf_password = $_POST['user_conf_password'];
    $user_ip = getIPAddress();

    if (empty($user_username) || empty($user_email) || empty($user_address) || empty($user_mobile) || empty($user_password) || empty($user_conf_password)) {
        echo "<script>alert('Please fill in all the required fields.')</script>";
        exit;
    }

    $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format. Please enter a valid email.')</script>";
        exit;
    }

    if (!ctype_digit($user_mobile)) {
        echo "<script>alert('Invalid mobile number. Please enter a valid mobile number.')</script>";
        exit;
    }

    $select_query = "SELECT * FROM `user_table` WHERE user_username='$user_username' OR user_email='$user_email'";
    $select_result = mysqli_query($_con, $select_query);
    $num_rows = mysqli_num_rows($select_result);
    
    if ($num_rows > 0) {
        echo "<script>alert('Sorry! Your username or email is already exist.')</script>";
    } elseif ($user_password != $user_conf_password) {
        echo "<script>alert('Passwords do not match.')</script>";
    } else {
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        $hashed_password = md5($user_password);

        $insert_data = "INSERT INTO `user_table` (user_username, user_email, user_password, user_image, user_ip, user_address, user_mobile) VALUES ('$user_username', '$user_email', '$hashed_password', '$user_image', '$user_ip', '$user_address', '$user_mobile')";

        $result = mysqli_query($_con, $insert_data);
        if ($result) {
            echo "<script>alert('Congratulations! You are registered.')</script>";
        } else {
            echo "<script>alert('Oops! Something went wrong. Please try again.')</script>";
        }

        $select_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $cart_result = mysqli_query($_con, $select_cart);
        $num_rows_cart = mysqli_num_rows($cart_result);

        if ($num_rows_cart > 0) {
            $_SESSION['username'] = $user_username;
            echo "<script>alert('You have some items in the cart')</script>";
            echo "<script>window.open('../checkout.php','_self')</script>";
        } else {
            echo "<script>window.open('../index.php','_self')</script>";
        }
    }
}
?>
