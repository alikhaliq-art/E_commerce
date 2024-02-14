<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="../style.css">

    <title>Admin Panel</title>

    <style>
        .admin_img {
            width: 100px !important;
            object-fit: contain;
        }

        footer{
            position: absolute;
            bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info navbar-light text-white">
            <div class="container-fluid">
                <img src="../images/cart_img.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">Welcome Guest</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <div class="bg-light">
            <h3 class="text-center p-2">
                Manage Details
            </h3>
        </div>

        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-4">
                    <a href=""><img src="../images/admin_img.png" class="admin_img" alt=""></a>
                    <p class="text-light text-center">Admin</p>
                </div>
                <div class="button text-center ">
                    <button class="btn btn-info text-light my-3"><a href="insert_product.php"  class="nav-link" >Insert Products</a></button>
                    <button class="btn btn-info text-light my-3"><a href="" class="nav-link">View Products</a></button>
                    <button class="btn btn-info text-light my-3"><a href="index.php?insert_category" class="nav-link" >Insert Categories</a></button>
                    <button class="btn btn-info text-light my-3"><a href="" class="nav-link" >View Categories</a></button>
                    <button class="btn btn-info text-light my-3"><a href="index.php?insert_brand" class="nav-link" >Insert Brands</a></button>
                    <button class="btn btn-info text-light my-3"><a href="" class="nav-link" >View Brands</a></button>
                    <button class="btn btn-info text-light my-3"><a href="" class="nav-link" >All Orders</a></button>
                    <button class="btn btn-info text-light my-3"><a href="" class="nav-link" >All Payments</a></button>
                    <button class="btn btn-info text-light my-3"><a href="" class="nav-link" >List Users</a></button>
                    <button class="btn btn-info text-light my-3"><a href="" class="nav-link" >Logout</a></button>
                </div>
            </div>
        </div>

        <div class="container my-3">
            <?php 
            if (isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if (isset($_GET['insert_brand'])){
                include('insert_brands.php');
            }
            ?>
        </div>
    </div>

    <footer class="bg-info text-center p-3">
            <p><strong>“All Rights Reserved © 2023 Your Ali Khaliq. Shopping Center"</strong></p>
    </footer>


</body>

</html>