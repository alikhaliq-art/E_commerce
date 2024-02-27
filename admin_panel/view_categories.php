<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.0/datatables.min.css" rel="stylesheet">
    <title>All Categories</title>
</head>
<body>
    <div>
        <?php

        if (isset($_POST['insert_cat'])) {
            $category_title = $_POST['cat_title'];

            $sql_select = "SELECT * FROM `category` WHERE cat_name='$category_title'";
            $result_select = mysqli_query($_con, $sql_select);

            if ($result_select) {
                $num_rows = mysqli_num_rows($result_select);

                if ($num_rows > 0) {
                    echo '<script>alert("Your Category is already present!");</script>';
                } else {
                    $sql = "INSERT INTO `category` (cat_name) VALUES ('$category_title')";
                    $result = mysqli_query($_con, $sql);

                    if ($result) {
                        echo '<script>alert("Your Category has been added successfully!");</script>';
                    } else {
                        echo '<script>alert("Error adding category: ' . mysqli_error($_con) . '");</script>';
                    }
                }
            } else {
                echo '<script>alert("Error checking category: ' . mysqli_error($_con) . '");</script>';
            }
        }
        ?>


        <h2 class="text-center text-info">Insert Categories</h2>
        <form action="" method="post">
            <div class="input-group w-90 mb-3">
                <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
                <input type="text" class="form-control" placeholder="Insert Category" name="cat_title" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <input type="submit" class="bg-info border-0 p-2 my-2" name="insert_cat" value="Insert Categories">
        </form>
    </div>
    <div>
        <h1 class="text-center text-success my-3">All Categories</h1>
        <table class="table table-striped table-bordered text-center" id="myTable">
            <thead class="bg-info">
                <tr>
                    <th>Sr.no</th>
                    <th>Category Title</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.0/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_categories.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var table = $('#myTable').DataTable();
                    $.each(data, function(index, category) {
                        table.row.add([
                            index + 1,
                            category.cat_name,
                            '<a href="index.php?edit_category=' + category.cat_id + '" class=""><i class="text-success fa fa-solid fa-pen-to-square"></i></a>',
                            '<a href="index.php?delete_category=' + category.cat_id + '" class=""><i class="text-danger fa fa-solid fa-trash"></i></a>'
                        ]).draw(false);
                    });
                }
            });
        });
    </script>
</body>
</html>