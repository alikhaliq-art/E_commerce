<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.0/datatables.min.css" rel="stylesheet">

    <title>All BRANDS</title>
</head>

<body>
    <div>
        <?php
        if (isset($_POST['insert_bra'])) {
            $brand_title = $_POST['brand_title'];

            $sql_select = "SELECT * FROM `brand` WHERE brand_name='$brand_title'";
            $result_select = mysqli_query($_con, $sql_select);

            if ($result_select !== false) { // check if query executed successfully
                $num_rows = mysqli_num_rows($result_select);

                if ($num_rows > 0) {
                    echo '<script>alert("Your Brand is already present!");</script>';
                } else {
                    $sql = "INSERT INTO `brand` (brand_name) VALUES ('$brand_title')";
                    $result = mysqli_query($_con, $sql);

                    if ($result !== false) { // check if query executed successfully
                        echo '<script>alert("Your Brand has been added successfully!");</script>';
                    } else {
                        echo '<script>alert("Error adding brand: ' . mysqli_error($_con) . '");</script>';
                    }
                }
            } else {
                echo '<script>alert("Error checking brand: ' . mysqli_error($_con) . '");</script>';
            }
        }
        ?>


        <h2 class="text-center text-info">Insert Brands</h2>
        <form action="" method="post">
            <div class="input-group w-90 mb-3">
                <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
                <input type="text" class="form-control" placeholder="Insert Brands" name="brand_title" aria-label="brands" aria-describedby="basic-addon1">
            </div>
            <input type="submit" class="bg-info border-0 p-2 my-2" name="insert_bra" value="Insert Brand">
        </form>
    </div>
    <h1 class="text-center text-success my-3">
        All Brands
    </h1>
    <table class="table table-striped table-bordered text-center" id="myTable">
        <thead class="bg-info">
            <tr>
                <th>Sr.no</th>
                <th>Brand Title</th>
                <th scope="col" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_brand = "SELECT * FROM `brand`";
            $result_brand = mysqli_query($_con, $select_brand);
            $number = 0;
            while ($row = mysqli_fetch_assoc($result_brand)) {
                $brand_id = $row['brand_id'];
                $brand_title = $row['brand_name'];
                $number++;
            ?>
                <tr class='align-items-center'>
                    <td><?php echo $number; ?></td>
                    <td><?php echo $brand_title; ?></td>
                    <td><a href='index.php?edit_brand=<?php echo $brand_id; ?>' class=''><i class='text-success fa fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='index.php?delete_brand=<?php echo $brand_id; ?>' class=''><i class='text-danger fa fa-solid fa-trash'></i></a></td>
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