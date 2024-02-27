<?php 
if (isset($_GET['edit_brand'])) {
    $edit_id=$_GET['edit_brand'];
    
    $edit_query="SELECT * FROM `brand` WHERE brand_id=$edit_id ";
    $result_edit=mysqli_query($_con,$edit_query);
    $row_edit=mysqli_fetch_assoc($result_edit);
    $brand_title=$row_edit['brand_name'];
}

if (isset($_POST['edit_brand'])) {
    $brand_title=$_POST['brand_title'];

    $update_query="UPDATE `brand` SET brand_name='$brand_title' WHERE brand_id=$edit_id ";
    $result_update=mysqli_query($_con,$update_query);
    if ($result_update) {
        echo"<script>alert('Brand has been updated successfully!')</script>";
        echo"<script>window.open('./index.php?view_brand','_self')</script>";
    }
}

?>
<div class="container my-4">
<h2 class="text-center">Edit brand</h2>
<form action="" method="post" class="text-center">
<div class="input-group w-50 m-auto">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="brand_title" required="required" value="<?php echo $brand_title; ?>">
</div>
<input type="submit" class="bg-info border-0 p-2 my-2" name="edit_brand" value="Update brand" >

</form>
</div>
