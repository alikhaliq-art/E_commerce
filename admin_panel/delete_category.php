<?php 
if (isset($_GET['delete_category'])) {
    $delete_id=$_GET['delete_category'];

    $delete_query="DELETE FROM `category` where cat_id=$delete_id";
    $delete_result=mysqli_query($_con,$delete_query);
    if ($delete_result) {
        echo"<script>alert('Deleted successfully !')</script>";
        echo"<script>window.open('index.php?view_categories','_self')</script>";
    }
}

?>