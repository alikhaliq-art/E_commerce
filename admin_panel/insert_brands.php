<?php
include('../includes/connect.php');

if(isset($_POST['insert_bra'])){
    $brand_title = $_POST['brand_title'];

    $sql_select = "SELECT * FROM `brand` WHERE brand_name='$brand_title'";
    $result_select = mysqli_query($_con, $sql_select);

    if($result_select){
        $num_rows = mysqli_num_rows($result_select);

        if($num_rows > 0){
            echo '<script>alert("Your Category is already present!");</script>';
        } else {
            $sql = "INSERT INTO `brand` (brand_name) VALUES ('$brand_title')";
            $result = mysqli_query($_con, $sql);

            if($result){
                echo '<script>alert("Your Category has been added successfully!");</script>';
            } else {
                echo '<script>alert("Error adding category: ' . mysqli_error($_con) . '");</script>';
            }
        }
    } else {
        echo '<script>alert("Error checking category: ' . mysqli_error($_con) . '");</script>';
    }
}
?>

<h2 class="text-center">Insert Brands</h2>
<form action="" method="post">
<div class="input-group w-90 mb-3">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" placeholder="Insert Brands" name="brand_title" aria-label="brands" aria-describedby="basic-addon1">
</div>
<input type="submit" class="bg-info border-0 p-2 my-2" name="insert_bra" value="Insert Brand" >
</form>