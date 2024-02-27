<?php 
if (isset($_GET['edit_category'])) {
    $edit_id=$_GET['edit_category'];
    
    $edit_query="SELECT * FROM `category` WHERE cat_id=$edit_id ";
    $result_edit=mysqli_query($_con,$edit_query);
    $row_edit=mysqli_fetch_assoc($result_edit);
    $cat_title=$row_edit['cat_name'];
}

if (isset($_POST['edit_cat'])) {
    $cat_name=$_POST['cat_title'];

    $update_query="UPDATE `category` SET cat_name='$cat_name' WHERE cat_id=$edit_id ";
    $result_update=mysqli_query($_con,$update_query);
    if ($result_update) {
        echo"<script>alert('Category has been updated successfully!')</script>";
        echo"<script>window.open('./index.php?view_categories','_self')</script>";
    }
}

?>
<div class="container my-4">
<h2 class="text-center">Edit Category</h2>
<form action="" method="post" class="text-center">
<div class="input-group w-50 m-auto">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="cat_title" required="required" value="<?php echo$cat_title; ?>">
</div>
<input type="submit" class="bg-info border-0 p-2 my-2" name="edit_cat" value="Update Category" >

</form>
</div>
