<?php
include('../includes/connect.php');
session_start();
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $select_order = "SELECT * FROM `user_orders` WHERE order_id=$order_id";
    $result_order = mysqli_query($_con, $select_order);
    
    if ($result_order) {
        $row_fetch = mysqli_fetch_assoc($result_order);
        if ($row_fetch) {
            $invoice_number = $row_fetch['invoice_number'];
            $amount = $row_fetch['amount'];
        } else {
            echo "No records found for the given order ID.";
        }
    } else {
        echo "Error executing query: " . mysqli_error($_con);
    }
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_method=$_POST['payment_method'];
    $insert_payment="INSERT INTO `user_payments` (order_id,invoice_number,amount,method) values ($order_id,$invoice_number,$amount,'$payment_method')";
    $result_payment=mysqli_query($_con,$insert_payment);

    if ($result_payment) {
        echo "<h3 class='text-success text-center'>Payment is done successfully</h3>";
        echo "<script>window.open ('profile.php?my_orders','_self')</script>";
        $update_query="UPDATE `user_orders` SET order_status='Complete' WHERE order_id=$order_id";
        $result_update=mysqli_query($_con,$update_query);
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

    <title>Payment Page</title>
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="text-center my-3">Confirm Payment</h1>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="my-3 form-outline w-50 m-auto">
                <label for="invoice_number" class="form-label">Invoice Number</label>
                <input type="text" class="form-control"  name="invoice_number" value="<?php echo $invoice_number ?>">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="amount" class="form-label">Amount</label>
                <input type="text" class="form-control" name="amount" value="<?php echo $amount ?>">
            </div>

            <div class="my-3 form-outline w-50 m-auto">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="">Select your payment method</option>
                    <option value="JazzCash">JazzCash</option>
                    <option value="Pay Offline">Pay Offline</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Payoneer">Payoneer</option>
                    <option value="Easypaisa">Easypaisa</option>
                </select>
            </div>

            <div class="my-3 form-outline w-50 m-auto text-center">
                <input type="submit" class="btn btn-info" id="confirm_payment" name="confirm_payment" value="Confirm">
            </div>

        </form>
    </div>
</body>
</html>
