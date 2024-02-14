<?php 
if (isset($_GET['edit-account'])) {
    $user_username = $_SESSION['user_username'];
    $user_edit_query = "SELECT * FROM `user_table` WHERE user_username='$user_username'";
    $user_edit_result = mysqli_query($_con, $user_edit_query);
    $row_fetch = mysqli_fetch_assoc($user_edit_result);
    $user_id = $row_fetch['user_id'];
    $user_username = $row_fetch['user_username'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_mobile'];
    $user_image = $row_fetch['user_image'];
}

    if (isset($_POST['update_account'])) {
        $new_username =$_POST['user_username'];
        $new_email =$_POST['user_email'];
        $new_address =$_POST['user_address'];
        $new_mobile =$_POST['user_mobile'];
        $user_image = $_FILES['user_image']['name'];
        $user_tmp_image = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_tmp_image, "./user_images/$user_image");

        // Update the user details in the database
        $update_query = "UPDATE `user_table` SET user_username = '$new_username',user_email = '$new_email',user_address = '$new_address',user_mobile = '$new_mobile',user_image = '$user_image' WHERE user_id = $user_id";

        $update_result = mysqli_query($_con, $update_query);

        if ($update_result) {
            echo "<script>alert('Account updated successfully.')</script>";
            echo "<script>window.open('user_logout.php','_self')</script>";
            // Optionally, update session variables with the new values
            $_SESSION['user_username'] = $new_username;
            $_SESSION['user_email'] = $new_email;
            $_SESSION['user_address'] = $new_address;
            $_SESSION['user_mobile'] = $new_mobile;
            $_SESSION['user_image'] = $user_image;
        } else {
            echo "<script>alert('Failed to update account. Please try again.')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        .edit_profile{
            width:100px;
            height:100px;
            object-fit:contain;
        }
    </style>
</head>
<body>
<div class="container">
           <h1 class="text-center text-success my-3">Edit Account</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="my-3 form-outline w-50 m-auto">
            <label for="user_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="user_username" placeholder=" Enter your username" name="user_username" value="<?php echo $user_username ?>" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="user_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $user_email ?>" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto d-flex">
            <label for="user_image" class="form-label">Profile</label>
            <input type="file" class="form-control m-auto" id="user_image" name="user_image" required="required">
            <img src="./user_images/<?php echo $user_image ?>" class="edit_profile" alt="">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="user_address" class="form-label">Address</label>
                <input class="form-control " type="text" id="user_address" name="user_address" value="<?php echo $user_address ?>" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="user_mobile" class="form-label">Mobile</label>
                <input class="form-control" type="text" id="user_mobile" name="user_mobile" required="required" placeholder=" Enter your mobile number" value="<?php echo $user_mobile ?>">
            </div>

            <div class="my-3 form-outline w-50 m-auto text-center">
            <input type="submit" class="btn btn-success" id="update_account" name="update_account" value="Update Account">
            </div>

    </form>
    </div>
</body>
</html>
