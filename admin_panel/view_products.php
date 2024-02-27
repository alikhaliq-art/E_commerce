<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.0/datatables.min.css" rel="stylesheet">

    <style>
        .product_img {
            width: 125px;
            object-fit: contain;
        }
    </style>
    <title>All products</title>
</head>

<body>
    <h1 class="text-center text-success my-3">
        All Products
    </h1>
    <table class="table table-striped table-bordered text-center" id="myTable">
        <thead class="bg-info">
            <tr>
                <th>Product Id</th>
                <th>Product Title</th>
                <th>Product Price</th>
                <th>Product Image</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th scope="col" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_products = "SELECT * FROM `products`";
            $result_products = mysqli_query($_con, $select_products);
            $number = 0;
            while ($row = mysqli_fetch_assoc($result_products)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $status = $row['status'];
                $number++;
            ?>
                <tr class='align-middle'>
                    <td><?php echo $number; ?></td>
                    <td><?php echo $product_title; ?></td>
                    <td><?php echo $product_price; ?>/-</td>
                    <td><img src='./product_image/<?php echo $product_image1; ?>' class='product_img'></td>
                    <td><?php
                        $select_pending = "SELECT * FROM `orders_pending` WHERE product_id=$product_id ";
                        $result_count = mysqli_query($_con, $select_pending);
                        $rows_count = mysqli_num_rows($result_count);
                        echo "$rows_count";
                        ?></td>
                    <td><?php echo $status; ?></td>
                    <td><a href='index.php?edit_products=<?php echo $product_id; ?>' class=''><i class='text-success fa fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='index.php?delete_products=<?php echo $product_id; ?>' class=''><i class='text-danger fa fa-solid fa-trash'></i></a></td>
                </tr>
            <?php
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