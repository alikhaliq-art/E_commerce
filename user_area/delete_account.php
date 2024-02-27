<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h3 class="text-danger text-center my-5">Delete Account</h3>
    <form action="" method="post" class="my-2">
        <div class="my-3 form-outline w-50 m-auto">
                    <input type="submit" class="form-control mb-3"  name="delete" value="Delete Account">
        </div>
        <div class="my-3 form-outline w-50 m-auto">
                    <input type="submit" class="form-control mb-3"  name="dont_delete" value="Don't Delete Account">
        </div>
    </form>
</body>
</html>

<?php
    $user_username = $_SESSION['user_username'];
    if (isset($_POST['delete'])) {
        $delete_query="DELETE FROM `user_table` WHERE user_username='$user_username' ";
        $result=mysqli_query($_con,$delete_query);
        if ($result) {
            session_destroy();
            echo "<script>alert('Account deleted Successfully')</script>";
            echo "<script>window.open('../index.php','_self')</script>";
        }

    }
    if (isset($_POST['dont_delete'])) {
        echo "<script>window.open('profile.php','_self')</script>";

    }



?>