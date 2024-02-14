<?php
include('../includes/connect.php');
if (isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $description=$_POST['description'];
    $product_keywords=$_POST['product_keywords'];
    $product_categories=$_POST['product_categories'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];

                    
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];

    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    if ($product_title=='' or  $description=='' or $product_keywords=='' or $product_categories=='' or $product_brands=='' or $product_price=='' or $product_image1=='' or $product_image2=='' or $product_image3=='') {
        echo"<script>alert('Please fill all the available fields')</script>";
    }else{
        move_uploaded_file($temp_image1,"./product_image/$product_image1");
        move_uploaded_file($temp_image2,"./product_image/$product_image2");
        move_uploaded_file($temp_image3,"./product_image/$product_image3");

        $insert= "INSERT INTO `products` (`product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`,   `dt`, `status`) VALUES ('$product_title', '$description', '$product_keywords', '$product_categories', '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), 'true');";
        $result=mysqli_query($_con,$insert);
        if ($result) {
            echo"<script>alert('Successfully inserted !')</script>";
        }

    }

}
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

    <title>Add Products</title>
</head>
<body class="bg-light">
    <div class="container">
           <h1 class="text-center my-3">Insert Products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="my-3 form-outline w-50 m-auto">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" class="form-control" id="product_title" placeholder=" Enter Product title" name="product_title" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="description" class="form-label">Product Description</label>
            <input type="text" class="form-control" id="description" placeholder=" Enter Product description" name="description" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="product_keywords" class="form-label">Product keywords</label>
            <input type="text" class="form-control" id="product_keywords" placeholder=" Enter Product keywords" name="product_keywords" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="Product Category" class="form-label">Product Category</label>
            <select class="form-select" name="product_categories" required="required">
                <option selected>Select Category</option>
                <?php
                $select_categories = "SELECT * FROM `category`";
                $result_categories = mysqli_query($_con, $select_categories);

                while ($row = mysqli_fetch_assoc($result_categories)) {
                    $category_name = $row['cat_name'];
                    $category_id = $row['cat_id'];
                    echo "<option value='$category_id'>$category_name</option>";
                }
                ?>
            </select>

            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="product_brands" class="form-label">Product Brand</label>
            <select class="form-select" name="product_brands" required="required">
                <option selected>Select Brand</option>
                <?php
                $select_brand = "SELECT * FROM `brand`";
                $result_brand = mysqli_query($_con, $select_brand);

                while ($row = mysqli_fetch_assoc($result_brand)) {
                    $brand_name = $row['brand_name'];
                    $brand_id = $row['brand_id'];
                    echo "<option value='$brand_id'>$brand_name</option>";
                }
                ?>
            </select>
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input class="form-control" type="file" id="product_image1" name="product_image1" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input class="form-control" type="file" id="product_image2" name="product_image2" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input class="form-control" type="file" id="product_image3" name="product_image3" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="product_price" class="form-label">Product price</label>
            <input type="text" class="form-control" id="product_price" placeholder="Enter product price" name="product_price" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <input type="submit" class="btn btn-info" id="insert_product" name="insert_product" value="Insert Products">
            </div>

    </form>
    </div>
</body>
</html>