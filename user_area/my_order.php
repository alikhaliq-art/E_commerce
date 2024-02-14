<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php
    if (isset($_GET['my-orders'])) {
    $user_username = $_SESSION['user_username'];
    $order_query = "SELECT * FROM `user_table` WHERE user_username='$user_username'";
    $user_result = mysqli_query($_con, $order_query);
    $row_fetch = mysqli_fetch_assoc($user_result);
    $user_id = $row_fetch['user_id'];
}

?>
    <h3 class="text-center text-success my-3">All Orders</h3>
    <div class="container">
    <table class="table table-striped table-bordered text-center">
  <thead>
    <tr>
      <th class="bg-info">#</th>
      <th class="bg-info">Total Products</th>
      <th class="bg-info">Amount Due</th>
      <th class="bg-info">Invoice</th>
      <th class="bg-info">Date</th>
      <th class="bg-info">Complete/Incomplete</th>
      <th class="bg-info">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $get_user_orders = "SELECT * FROM `user_orders` WHERE userll_id='$user_id'";
    $user_order_result = mysqli_query($_con, $get_user_orders);
    $number=1;
    while ($row_orders=mysqli_fetch_assoc($user_order_result)) {
        $order_id=$row_orders['order_id'];
        $amount=$row_orders['amount'];
        $invoice_number=$row_orders['invoice_number'];
        $total_products=$row_orders['total_products'];
        $order_date=$row_orders['order_date'];
        $order_status=$row_orders['order_status'];
        if ($order_status=='pending') {
            $order_status='Incomplete';
        }else{
            $order_status='Complete';
        }
        echo "
            <tr>
            <th scope='row'>$number</th>
            <td>$total_products</td>
            <td>$amount</td>
            <td>$invoice_number</td>
            <td>$order_date</td>
            <td>$order_status</td>
            <td><a href'confirm_payment.php' class='text-success cursor-pointer'role='button' tabindex='0'>Confirm</a></td>
            </tr>";
            $number++;
    }

    
    
    
    ?>
  </tbody>
</table>
    </div>
</body>
</html>