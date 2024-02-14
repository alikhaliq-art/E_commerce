<?php
include('./includes/connect.php');
include('./function/common_functions.php');
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart Detail</title>

    <!-- <link rel="stylesheet" href="style.css"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">
    <style>
        .card-img-top{
    width: 100%;
    height: 200px;
    object-fit: contain;
    }
        .cart_img{
    width: 150px;
    height: 150px;
    object-fit: contain;
    }
    </style>

</head>

<body>
    <div class="container_fluid">
        <nav class="navbar navbar-expand-lg bg-info navbar-light text-white">
            <div class="container-fluid">
                <img src="./images/cart_img.png" class="logo" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./user_area/user_registeration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-arrow-down"></i><sup><?php cart_num()?></sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-lg bg-secondary navbar-dark mb-2">
            <ul class="navbar-nav me-auto">
                <?php 
                if (!isset($_SESSION['user_username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link text-white' href='#'>Welcome Guest</a>
                </li>";
                }else{
                    echo"<li class='nav-item'>
                    <a class='nav-link text-white' href='#'>Welcome <strong class='text-warning'>".$_SESSION['user_username']."</strong> </a>
                    </li>";
                }


                if (!isset($_SESSION['user_username'])){
                    echo "                <li class='nav-item'>
                    <a class='nav-link text-white' href='./user_area/user_login.php'>Login</a>
                    </li>";
                }else{
                    echo"<li class='nav-item'>
                    <a class='nav-link text-white' href='./user_area/user_logout.php'>Logout</a>
                </li>";
                }
                ?>
            </ul>
        </nav>
        
               <?php
                 cart_detail();
                ?>

        <div class="bg-light text-center p-3">
            <h2 class="text-success" >Shopping Details</h2>
        </div>

        <div class="container">
            <div class="row">
<form action="" method="post">
    <?php
    global $_con;
    $ip = getIPAddress();
    $select_query = "SELECT * FROM `cart_details` WHERE ip_address = '$ip'";
    $result_query = mysqli_query($_con, $select_query);
    $num_rows = mysqli_num_rows($result_query);

    if ($num_rows == 0) {
        echo "<h2 class='text-center text-danger'>Cart is empty.</h2>";
        echo "<div class='d-flex my-4'>
            <input name='continue' value='Continue shopping' class='btn btn-info mx-3' type='submit'></input>
        </div>";
    } else {
        ?>
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Price</th>
                    <th scope="col" colspan="2">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $_con;
                $ip = getIPAddress();
                $total_price = 0;
                $select_query = "SELECT * FROM `cart_details` WHERE ip_address = '$ip'";
                $result_query = mysqli_query($_con, $select_query);

                while ($row = mysqli_fetch_array($result_query)) {
                    $product_id = $row['product_id'];
                    $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
                    $result_products = mysqli_query($_con, $select_products);

                    while ($row_product_price = mysqli_fetch_array($result_products)) {
                        $product_price = $row_product_price['product_price'];
                        $product_title = $row_product_price['product_title'];
                        $product_image1 = $row_product_price['product_image1'];
                        $quantity = $row['quantity'];
                        $total_price += $product_price * $quantity;
                
                        ?>

                        <tr>
                            <th scope='row'><?php echo $product_title ?></th>
                            <td><img src='./admin_panel/product_image/<?php echo $product_image1 ?>' class='cart_img' alt=''></td>
                            <td>
                                <!-- Set initial value to 1 -->
                                <input type='number' value='<?php echo max(1, $quantity); ?>' name='qty_<?php echo $product_id ?>'>
                            </td>
                            <td><strong><?php echo $product_price ?></strong></td>
                            <td><strong><?php echo $total_price ?></strong></td>
                            <td>
                                <input type='hidden' name='' value=''>
                                <input class='btn btn-success mx-2' type='submit' value='Update' name='update_cart_<?php echo $product_id ?>'>
                                <input class='btn btn-danger mx-2' type='submit' value='Remove' name='remove_cart_<?php echo $product_id ?>'>
                            </td>
                        </tr>
                <?php }} ?>
            </tbody>
        </table>

        <div class="d-flex my-4">
            <h4 class="px-3">Sub-total: <strong class="text-primary"><?php echo $total_price; ?></strong>/-</h4>
            <input name='continue' value='Continue shopping' class='btn btn-info mx-3' type='submit'></input>
            <input name='checkout' value='Checkout' class='btn btn-dark btn-outline' type='submit'></input>
        </div>
        <?php
    }

    if (isset($_POST['continue'])) {
        echo "<script>window.open('index.php', '_self')</script>";
    }

    if (isset($_POST['checkout'])) {
        echo "<script>window.open('./user_area/checkout.php', '_self')</script>";
    }

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'update_cart_') !== false) {
            $product_id = substr($key, strlen('update_cart_'));
            $quantity = $_POST['qty_' . $product_id];

            $update_cart = "UPDATE `cart_details` SET quantity=$quantity WHERE ip_address='$ip' AND product_id=$product_id";
            mysqli_query($_con, $update_cart);
        }
    }

foreach ($_POST as $key => $value) {
    if (strpos($key, 'update_cart_') !== false) {
    } elseif (strpos($key, 'remove_cart_') !== false) {
        $product_id = substr($key, strlen('remove_cart_'));

        $remove_cart = "DELETE FROM `cart_details` WHERE ip_address='$ip' AND product_id=$product_id";
        mysqli_query($_con, $remove_cart);
    }
}
    ?>
</form>



        <div class="bg-info text-center p-3">
            <p><strong>“All Rights Reserved © 2023 Your Ali Khaliq. Shopping Center"</strong></p>
        </div>



    </div>












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>