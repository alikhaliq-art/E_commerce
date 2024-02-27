<?php 
if (isset($_GET['delete_brand'])) {
    $delete_id=$_GET['delete_brand'];

    $delete_query="DELETE FROM `brand` where brand_id=$delete_id";
    $delete_result=mysqli_query($_con,$delete_query);
    if ($delete_result) {
        echo"<script>alert('Deleted successfully !')</script>";
        echo"<script>window.open('index.php?view_brand','_self')</script>";
    }
}

?>