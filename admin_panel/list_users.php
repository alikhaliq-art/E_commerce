<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.0/datatables.min.css" rel="stylesheet">

    <title>All Users</title>
</head>

<body>
    <h1 class="text-center text-success my-3">
        All User
    </h1>
    <table class="table table-striped table-bordered text-center" id="myTable">
        <thead class="bg-info">
            <?php
            $user_query = "SELECT * FROM `user_table`";
            $result_user = mysqli_query($_con, $user_query);
            $row_user = mysqli_num_rows($result_user);
            if ($row_user == 0) {
                echo "<h1 class='text-danger text-center my-5'>No user Yet!</h1>";
            } else {
                echo "<tr>
            <th>Sr.no</th>
            <th>Username</th>
            <th>Email</th>
            <th>Image</th>
            <th>Address</th>
            <th>Mobile</th>
            </tr>
        </thead>
        <tbody>";
                $number = 0;
                while ($row_data = mysqli_fetch_assoc($result_user)) {
                    $user_id = $row_data['user_id'];
                    $user_username = $row_data['user_username'];
                    $user_email = $row_data['user_email'];
                    $user_image = $row_data['user_image'];
                    $user_ip = $row_data['user_ip'];
                    $user_address = $row_data['user_address'];
                    $user_mobile = $row_data['user_mobile'];
                    $number++;
                    echo "            <tr class='align-middle'>
                <td>$number</td>
                <td>$user_username</td>
                <td>$user_email</td>
                <td><img src='../user_area/user_images/$user_image' class='admin_img'></td>
                <td>$user_address</td>
                <td>$user_mobile</td>
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