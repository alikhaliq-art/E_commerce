<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.0/datatables.min.css" rel="stylesheet">

    <title>All Payments</title>
</head>

<body>
    <h1 class="text-center text-success my-3">
        All Payments
    </h1>
    <table class="table table-striped table-bordered text-center" id="myTable">
        <thead class="bg-info">
            <?php
            $payment_query = "SELECT * FROM `user_payments`";
            $result_payments = mysqli_query($_con, $payment_query);
            $row_payments = mysqli_num_rows($result_payments);
            if ($row_payments == 0) {
                echo "<h1 class='text-danger text-center my-5'>No payments Yet!</h1>";
            } else {
                echo "<tr>
            <th>Sr.no</th>
            <th>Username</th>
            <th>Amount</th>
            <th>Invoice Number</th>
            <th>Payment Mode</th>
            <th>Date</th>
            </tr>
        </thead>
        <tbody>";
                $number = 0;
                while ($row_data = mysqli_fetch_assoc($result_payments)) {
                    $user_query = "SELECT * FROM `user_table`";
                    $result_user = mysqli_query($_con, $user_query);
                    $row_user = mysqli_fetch_assoc($result_user);
                    $user_username = $row_user['user_username'];

                    $order_id = $row_data['order_id'];
                    $payment_id = $row_data['payment_id'];
                    $amount = $row_data['amount'];
                    $invoice_number = $row_data['invoice_number'];
                    $order_date = $row_data['dat'];
                    $method = $row_data['method'];
                    $number++;
                    echo "            <tr>
                <td>$number</td>
                <td>$user_username</td>
                <td>$amount</td>
                <td>$invoice_number</td>
                <td>$method</td>
                <td>$order_date</td>
            </tr>";
                }
            }
            ?>
            </tbody>
    </table>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.0/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>