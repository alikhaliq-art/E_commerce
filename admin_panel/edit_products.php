<?php
if (isset($_GET['edit_products'])) {
    $get_id=$_GET['edit_products'];
    $select_edit_product="SELECT * FROM `products` WHERE product_id=$get_id ";
    $result_edit=mysqli_query($_con,$select_edit_product);
    $row_edit=mysqli_fetch_assoc($result_edit);
    $product_title=$row_edit['product_title'];
    $product_description=$row_edit['product_description'];
    $product_keywords=$row_edit['product_keywords'];
    $category_id=$row_edit['category_id'];
    $brand_id=$row_edit['brand_id'];
    $product_image1=$row_edit['product_image1'];
    $product_image2=$row_edit['product_image2'];
    $product_image3=$row_edit['product_image3'];
    $product_price=$row_edit['product_price'];

    $select_category="SELECT * FROM `category` WHERE cat_id=$category_id";
    $result_category=mysqli_query($_con,$select_category);
    $row_category=mysqli_fetch_assoc($result_category);
    $categery_title=$row_category['cat_name'];


    $select_brand="SELECT * FROM `brand` WHERE brand_id=$brand_id";
    $result_brand=mysqli_query($_con,$select_brand);
    $row_brand=mysqli_fetch_assoc($result_brand);
    $brand_title=$row_brand['brand_name'];
}

?>

<div class="container">
           <h1 class="text-center my-3">Edit Products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="my-3 form-outline w-50 m-auto">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" class="form-control" id="product_title" placeholder=" Enter Product title" name="product_title" value="<?php echo $product_title; ?>" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="description" class="form-label">Product Description</label>
            <input type="text" class="form-control" id="description" placeholder=" Enter Product description" name="description" value="<?php echo $product_description; ?>" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="product_keywords" class="form-label">Product keywords</label>
            <input type="text" class="form-control" id="product_keywords" placeholder=" Enter Product keywords" name="product_keywords" value="<?php echo $product_keywords; ?>" autocomplete="off" required="required">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="Product Category" class="form-label">Product Category</label>
            <select class="form-select" name="product_categories" required="required">
                <option selected value="<?php echo $categery_id; ?>"><?php echo $categery_title; ?></option>
                <?php
                    $select_category_all="SELECT * FROM `category`";
                    $result_category_all=mysqli_query($_con,$select_category_all);
                    while($row_category_all=mysqli_fetch_assoc($result_category_all)){
                        $categery_title_all=$row_category_all['cat_name'];
                        $category_id_all=$row_category_all['cat_id'];
                        echo "<option value='$category_id_all'>$categery_title_all</option>
                        ";
                    }
                ?>
            </select>
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="product_brands" class="form-label">Product Brand</label>
            <select class="form-select" name="product_brands" required="required">
                <option selected value="<?php echo $brand_id; ?>"><?php echo $brand_title; ?></option>
                <?php
                    $select_brand_all="SELECT * FROM `brand`";
                    $result_brand_all=mysqli_query($_con,$select_brand_all);
                    while($row_brand_all=mysqli_fetch_assoc($result_brand_all)){
                        $brand_title_all=$row_brand_all['brand_name'];
                        $brand_id_all=$row_brand_all['brand_id'];
                        echo "<option value='$brand_id_all'>$brand_title_all</option>
                        ";
                    }
                ?>
            </select>
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <div class="d-flex">
                <input class="form-control w-90 m-auto" type="file" id="product_image1" name="product_image1" required="required">
                <img src="./product_image/<?php echo $product_image1; ?>" alt="" class="admin_img">
                </div>
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <div class="d-flex">
                <input class="form-control w-90 m-auto" type="file" id="product_image2" name="product_image2" required="required">
                <img src="./product_image/<?php echo $product_image2; ?>" alt="" class="admin_img">
                </div>
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <div class="d-flex">
                <input class="form-control w-90 m-auto" type="file" id="product_image3" name="product_image3" required="required">
                <img src="./product_image/<?php echo $product_image3; ?>" alt="" class="admin_img">
                </div>
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <label for="product_price" class="form-label">Product price</label>
            <input type="text" class="form-control" id="product_price" placeholder="Enter product price" name="product_price" required="required" value="<?php echo $product_price; ?>">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
            <input type="submit" class="btn btn-info" id="edit_product" name="edit_product" value="Update Product">
            </div>

    </form>
    </div>
    <?php 
    if (isset($_POST['edit_product'])) {
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

            $update_query = "UPDATE `products` SET `product_title`='$product_title', `product_description`='$description', `product_keywords`='$product_keywords', `category_id`='$product_categories', `brand_id`='$product_brands', `product_image1`='$product_image1', `product_image2`='$product_image2', `product_image3`='$product_image3', `product_price`='$product_price', `dt`=NOW() WHERE `product_id`='$get_id'";
            $result_update = mysqli_query($_con, $update_query);
            if ($result_update) {
                echo"<script>alert('Successfully Updated !')</script>";
                echo"<script>window.open('./view_products.php','_self')</script>";
            }

        }

        
    }
    
    
    
    ?>