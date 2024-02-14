<?php
// include('./includes/connect.php');

function get_products(){
            global $_con;
            if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
             $select_query = "SELECT * FROM `products` order by rand() limit 0,6";
                    $result_query = mysqli_query($_con, $select_query);

                    while ($row_data = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row_data['product_id'];
                        $product_title = $row_data['product_title'];
                        $description = $row_data['product_description'];
                        $product_image1 = $row_data['product_image1'];
                        $product_price = $row_data['product_price'];
                        $product_category = $row_data['category_id'];
                        $product_brand = $row_data['brand_id'];

                        echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_panel/product_image/$product_image1' class='card-img-top' alt='Product Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$description</p>
                                        <p class='card-text'>Price: $product_price</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                        <a href='details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
                                    </div>
                                </div>
                            </div>";
                    }
}
}
}

function get_all_products(){
               global $_con;
            if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
             $select_query = "SELECT * FROM `products` order by rand()";
                    $result_query = mysqli_query($_con, $select_query);

                    while ($row_data = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row_data['product_id'];
                        $product_title = $row_data['product_title'];
                        $description = $row_data['product_description'];
                        $product_image1 = $row_data['product_image1'];
                        $product_price = $row_data['product_price'];
                        $product_category = $row_data['category_id'];
                        $product_brand = $row_data['brand_id'];

                        echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_panel/product_image/$product_image1' class='card-img-top' alt='Product Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$description</p>
                                        <p class='card-text'>Price: $product_price</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>                                        <a href='details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
                                    </div>
                                </div>
                            </div>";
                    }
}
} 
}

function get_unique_category(){
            global $_con;
            if (isset($_GET['category'])) {
            $category_id=$_GET['category'];
             $select_query= "SELECT * FROM `products` where category_id=$category_id";
                    $result_query = mysqli_query($_con,$select_query);
                    $num_rows=mysqli_num_rows($result_query);
                    if ($num_rows==0) {
                        echo "<h2 class='text-center text-danger'>Sorry! No stock available for this category.</h2>";
                    }

                    while ($row_data = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row_data['product_id'];
                        $product_title = $row_data['product_title'];
                        $description = $row_data['product_description'];
                        $product_image1 = $row_data['product_image1'];
                        $product_price = $row_data['product_price'];
                        $product_category = $row_data['category_id'];
                        $product_brand = $row_data['brand_id'];

                        echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_panel/product_image/$product_image1' class='card-img-top' alt='Product Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$description</p>
                                        <p class='card-text'>Price: $product_price</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>                                        <a href='details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
                                    </div>
                                </div>
                            </div>";
                    }
}
}

function get_unique_brand(){
            global $_con;
            if (isset($_GET['brand'])) {
            $brand_id=$_GET['brand'];
             $select_query= "SELECT * FROM `products` where brand_id=$brand_id";
                    $result_query = mysqli_query($_con,$select_query);
                    $num_rows=mysqli_num_rows($result_query);
                    if ($num_rows==0) {
                        echo "<h2 class='text-center text-danger'>Sorry! Such brand is not available.</h2>";
                    }

                    while ($row_data = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row_data['product_id'];
                        $product_title = $row_data['product_title'];
                        $description = $row_data['product_description'];
                        $product_image1 = $row_data['product_image1'];
                        $product_price = $row_data['product_price'];
                        $product_category = $row_data['category_id'];
                        $product_brand = $row_data['brand_id'];

                        echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_panel/product_image/$product_image1' class='card-img-top' alt='Product Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$description</p>
                                        <p class='card-text'>Price: $product_price</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>                                        <a href='details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
                                    </div>
                                </div>
                            </div>";
                    }
}
}

function get_brands(){
        global $_con;
      $select_brand="SELECT * from `brand`";
        $result_brand=mysqli_query($_con,$select_brand);
        while($row_data=mysqli_fetch_assoc($result_brand)){
            $brand_name=$row_data['brand_name'];
            $brand_id=$row_data['brand_id'];
            echo"<li class='nav-item text-center text-light'>
            <a class='nav-link' href='index.php?brand=$brand_id'>$brand_name</a>
        </li>";
        }
}

function get_categories(){
        global $_con;
        $select_categories="SELECT * from `category`";
        $result_categories=mysqli_query($_con,$select_categories);
        while($row_data=mysqli_fetch_assoc($result_categories)){
            $category_name=$row_data['cat_name'];
            $category_id=$row_data['cat_id'];
            echo"<li class='nav-item text-center text-light'>
            <a class='nav-link' href='index.php?category=$category_id'>$category_name</a>
        </li>";
        }
}

function search_product(){
            global $_con;
            if (isset($_GET['search_data_products'])) {
                $search_data=$_GET['search_data'];
                $search_query= "select * from `products` where product_keywords like '%$search_data%'";
                $result_query = mysqli_query($_con, $search_query);
                $result_query = mysqli_query($_con,$search_query);
                    $num_rows=mysqli_num_rows($result_query);
                    if ($num_rows==0) {
                        echo "<h2 class='text-center text-danger'>Sorry! Nothing match with your search.</h2>";
                    }
                    while ($row_data = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row_data['product_id'];
                        $product_title = $row_data['product_title'];
                        $description = $row_data['product_description'];
                        $product_image1 = $row_data['product_image1'];
                        $product_price = $row_data['product_price'];
                        $product_category = $row_data['category_id'];
                        $product_brand = $row_data['brand_id'];

                        echo "<div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./admin_panel/product_image/$product_image1' class='card-img-top' alt='Product Image'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>$description</p>
                                        <p class='card-text'>Price: $product_price</p>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>                                         <a href='details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
                                    </div>
                                </div>
                            </div>";
                    }
}
}

function details(){
                global $_con;
            if (isset($_GET['product_id'])) {
            if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
            $product_id = $_GET['product_id'];
             $select_query = "SELECT * FROM `products` where product_id=$product_id";
                    $result_query = mysqli_query($_con, $select_query);

                    while ($row_data = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row_data['product_id'];
                        $product_title = $row_data['product_title'];
                        $description = $row_data['product_description'];
                        $product_image1 = $row_data['product_image1'];
                        $product_image2 = $row_data['product_image2'];
                        $product_image3 = $row_data['product_image3'];
                        $product_price = $row_data['product_price'];
                        $product_category = $row_data['category_id'];
                        $product_brand = $row_data['brand_id'];

                        echo "
                        <div class='col-md-4'>
                    <div class='card'>
                        <img src='./admin_panel/product_image/$product_image1' class='card-img-top' alt='Product Image'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$description</p>
                            <p class='card-text'>Price: $product_price</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                            <a href='index.php' class='btn btn-secondary'>Go Home</a>
                        </div>
                    </div>
                </div>
                <div class='col-md-8'>
                    <div class='row'>
                    <div class='col-md-12 my-3'>
                        <h3 class='text-center text-success'>Related Products</h3>
                    </div>
                    <div class='col-md-6'>
                        <img src='./admin_panel/product_image/$product_image2' class='card-img-top' alt='Product Image'>
                    </div>
                    <div class='col-md-6'>
                        <img src='./admin_panel/product_image/$product_image3' class='card-img-top' alt='Product Image'>
                    </div>
                    </div>
                </div>";
}}}}}

function getIPAddress() {  
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    //whether ip is from the remote address  
    else {  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}  

function cart_detail() {
    if (isset($_GET['add_to_cart'])) {
        global $_con;
        $ip = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM `cart_details` WHERE product_id = $get_product_id AND ip_address = '$ip'";
        $result_query = mysqli_query($_con, $select_query);
        $num_rows = mysqli_num_rows($result_query);

        if ($num_rows > 0) {
            echo "<script>alert('This item is already added to your cart')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($get_product_id, '$ip', 0)";
            $result_query = mysqli_query($_con, $insert_query);

            if ($result_query) {
                echo "<script>alert('Item is successfully added to cart.')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            } else {
                echo "<script>alert('Error adding item to cart.')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            }
        }
    }
}

function cart_num() {
    global $_con;
    $ip = getIPAddress();

    if (isset($_GET['add_to_cart'])) {
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address = '$ip'";
        $result_query = mysqli_query($_con, $select_query);
        $num_rows = mysqli_num_rows($result_query);
    } else {
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address = '$ip'";
        $result_query = mysqli_query($_con, $select_query);
        $num_rows = mysqli_num_rows($result_query);
    }

    echo $num_rows;
}

function product_price(){
    global $_con;
    $ip = getIPAddress();
    $total_price=0;
    $select_query = "SELECT * FROM `cart_details` WHERE ip_address = '$ip'";
    $result_query = mysqli_query($_con, $select_query);
    while ($row=mysqli_fetch_array($result_query)) {
    $product_id=$row['product_id'];
    $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
    $result_products = mysqli_query($_con, $select_products);
     while ($row_product_price=mysqli_fetch_array($result_products)) {
    $product_price= array($row_product_price['product_price']);
    $product_values=array_sum($product_price);
    $total_price+=$product_values;
    }
    }
    echo $total_price;
}

function get_pending_orders(){
if (isset($_SESSION['user_username'])) {
    global $_con;
    $user_username = $_SESSION['user_username'];
    $user_pending = "SELECT * FROM `user_table` WHERE user_username='$user_username'";
    $user_pending_result = mysqli_query($_con, $user_pending);
    while($row_pending = mysqli_fetch_array($user_pending_result)){
        $user_id = $row_pending['user_id'];
        if (!isset($_GET['my-orders'])) {
            if (!isset($_GET['edit-account'])) {
                if (!isset($_GET['delete-account'])) {
                    $get_orders = "SELECT * FROM `user_orders` WHERE user_id='$user_id' AND order_status='pending'";
                    $get_order_result = mysqli_query($_con, $get_orders);
                    $row_count= mysqli_num_rows($get_order_result);
                    if ($row_count>0) {
                        echo "<h3 class='text-success text-center mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders.</h3>
                        <p class='text-center'><a href='profile.php?my-orders' class='text-center text-dark'>Order Details</a></p>";
                    }else{
                        echo "<h3 class='text-success text-center mt-5 mb-2'>You have <span class='text-danger'>Zero</span> pending orders.</h3>
                        <p class='text-center'><a href='../index.php?my-orders' class='text-dark'>Home</a></p>";
                    }
                }
            }
        }
    }




}
}









?>