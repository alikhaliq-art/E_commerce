<?php 
if (isset($_GET['delete_products'])) {
    $delete_id=$_GET['delete_products'];

    $delete_query="DELETE FROM `products` where product_id=$delete_id";
    $delete_result=mysqli_query($_con,$delete_query);
    if ($delete_result) {
        echo"<script>alert('Deleted successfully !')</script>";
        echo"<script>window.open('index.php?view_products','_self')</script>";
    }
}

?>