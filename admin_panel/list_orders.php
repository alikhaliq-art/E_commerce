<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.0/datatables.min.css" rel="stylesheet">

    <title>All Orders</title>
</head>

<body>
    <h1 class="text-center text-success my-3">
        All Orders
    </h1>
    <table class="table table-striped table-bordered text-center " id="myTable">
        <thead class="bg-info">
            <?php
            $order_query = "SELECT * FROM `user_orders`";
            $result_orders = mysqli_query($_con, $order_query);
            $row_orders = mysqli_num_rows($result_orders);
            if ($row_orders == 0) {
                echo "<h1 class='text-danger text-center my-5'>No Orders Yet!</h1>";
            } else {
                echo "<tr>
            <th>Sr.no</th>
            <th>Username</th>
            <th>Due Amount</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Date</th>
            <th>Status</th>
            </tr>
        </thead>
        <tbody>";
                $number = 0;
                while ($row_data = mysqli_fetch_assoc($result_orders)) {
                    $user_query = "SELECT * FROM `user_table`";
                    $result_user = mysqli_query($_con, $user_query);
                    $row_user = mysqli_fetch_assoc($result_user);
                    $user_username = $row_user['user_username'];

                    $order_id = $row_data['order_id'];
                    $user_id = $row_data['user_id'];
                    $amount = $row_data['amount'];
                    $invoice_number = $row_data['invoice_number'];
                    $total_products = $row_data['total_products'];
                    $order_date = $row_data['order_date'];
                    $order_status = $row_data['order_status'];
                    $number++;
                    echo "            <tr>
                <td>$number</td>
                <td>$user_username</td>
                <td>$amount</td>
                <td>$invoice_number</td>
                <td>$total_products</td>
                <td>$order_date</td>
                <td>$order_status</td>
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