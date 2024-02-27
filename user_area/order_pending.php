<?php
include('../includes/connect.php');
include('../function/common_functions.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$get_ip = getIPAddress();
$total_price = 0;
$invoice_number = mt_rand();
$status = 'pending';

// Fetch products from the cart
$product_query = "SELECT * FROM `cart_details` WHERE ip_address = '$get_ip'";
$result_product = mysqli_query($_con, $product_query);
$num_rows_product = mysqli_num_rows($result_product);

while ($row_price = mysqli_fetch_array($result_product)) {
    $product_id = $row_price['product_id'];
    $quantity = $row_price['quantity']; // Fetch quantity from the cart
    $select_products = "SELECT * FROM `products` WHERE product_id = $product_id";
    $products_select = mysqli_query($_con, $select_products);
    
    while ($row_product_price = mysqli_fetch_array($products_select)) {
        $product_price = $row_product_price['product_price'];
        // Calculate subtotal for each product (price * quantity)
        $sub_total = $product_price * $quantity;
        // Add subtotal to total price
        $total_price += $sub_total;

        // Insert each product into orders_pending table
        $insert_pending = "INSERT INTO `orders_pending` (`user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES ('$user_id', '$invoice_number', '$product_id', '$quantity', '$status')";
        $result_pending = mysqli_query($_con, $insert_pending);
    }
}

// Insert order into user_orders table
$insert_orders = "INSERT INTO `user_orders` (`user_id`, `amount`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES ('$user_id', '$total_price', '$invoice_number', '$num_rows_product', current_timestamp(), '$status')";
$result_orders = mysqli_query($_con, $insert_orders);

// Empty the cart
$empty_cart = "DELETE FROM `cart_details` WHERE `ip_address` = '$get_ip'";
$result_delete = mysqli_query($_con, $empty_cart);

if ($result_orders) {
    echo "<script>alert('Orders are submitted successfully.')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}
?>
