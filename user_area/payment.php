<?php
include('../includes/connect.php');
include('../function/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .upi{
            width:80%;
            margin: auto;
            display: block;
        }
    </style>
</head>
<body>
    <?php
    $user_ip = getIPAddress();

    $select_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
    $select_result = mysqli_query($_con, $select_user);
    $num_rows = mysqli_num_rows($select_result);
    $row_data = mysqli_fetch_assoc($select_result);
    $user_id = $row_data['user_id'];
    
    ?>
    <h2 class="text-center my-3 text-info"> Payment Options</h2>
    <div class="row d-flex justify-content-center align-items-center my-5">
        <div class="col-md-6">
            <a href="http://www.paypal.com" target="_blank" rel="noopener noreferrer"><img src="../images/payment.png" alt="payment" class="upi"></a>
        </div>
        <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id ?>"><h2 class="text-center">Pay Offline</h2></a>
        </div>
    </div>


</body>
</html>