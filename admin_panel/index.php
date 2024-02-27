<?php
include('../includes/connect.php');
include('../function/common_functions.php');
session_start();

?>
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
        body{
            overflow-x: hidden;
        }
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
                    <?php 
                if (!isset($_SESSION['admin_name'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link text-white' href=''>Welcome Guest</a>
                </li>";
                }else{
                    echo"<li class='nav-item'>
                    <a class='nav-link text-white' href='./user_area/profile.php'>Welcome <strong class='text-warning'>".$_SESSION['admin_name']."</strong> </a>
                    </li>";
                }
                ?>
                    </ul>
                </nav>
            </div>
        </nav>

        <div class="bg-light">
            <h3 class="text-center p-2">
                Manage Details
            </h3>
        </div>

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-4">
                    <a href=""><img src="../images/admin_img.png" class="admin_img" alt=""></a>
                    <ul>
                    <?php 
                if (!isset($_SESSION['admin_name'])){
                    echo "<p >
                    <a class='nav-link text-white' href=''>Welcome Admin</a>
                </p>";
                }else{
                    echo"<p >
                    <a class='nav-link text-white' href=''><strong class='text-warning'>".$_SESSION['admin_name']."</strong> </a>
                    </p>";
                }
                ?>
                    </ul>
                </div>
                <div class="button text-center ">
                <?php
                    if (isset($_SESSION['admin_name'])) {
                        echo "
                        <button class='btn btn-info text-light my-3 mx-1'><a href='insert_product.php'  class='nav-link' >Insert Products</a></button>

                        <button class='btn btn-info text-light my-3 mx-1'><a href='index.php?view_products' class='nav-link'>View Products</a></button>

                        <button class='btn btn-info text-light my-3 mx-1'><a href='index.php?view_categories' class='nav-link' >View Categories</a></button>

                        <button class='btn btn-info text-light my-3 mx-1'><a href='index.php?view_brand' class='nav-link' >View Brands</a></button>

                        <button class='btn btn-info text-light my-3 mx-1'><a href='index.php?list_orders' class='nav-link' >All Orders</a></button>

                        <button class='btn btn-info text-light my-3 mx-1'><a href='index.php?list_payments' class='nav-link' >All Payments</a></button>

                        <button class='btn btn-info text-light my-3 mx-1'><a href='index.php?list_users' class='nav-link' >List Users</a></button>

                        <button class='btn btn-info text-light my-3 mx-1'>
                            <a class='nav-link' href='admin_logout.php'>Logout</a>
                        </button>";
                    } else {
                        echo "<button class='btn btn-info text-light my-3 mx-1'>
                        <a class='nav-link' href='admin_login.php'>Login</a>
                        </button>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="container my-3">
            <?php 
            if (isset($_GET['view_products'])){
                include('view_products.php');
            }
            if (isset($_GET['edit_products'])){
                include('edit_products.php');
            }
            if (isset($_GET['delete_products'])){
                include('delete_products.php');
            }
            if (isset($_GET['view_categories'])){
                include('view_categories.php');
            }
            if (isset($_GET['view_brand'])){
                include('view_brand.php');
            }
            if (isset($_GET['edit_category'])){
                include('edit_category.php');
            }
            if (isset($_GET['edit_brand'])){
                include('edit_brand.php');
            }
            if (isset($_GET['delete_category'])){
                include('delete_category.php');
            }
            if (isset($_GET['delete_brand'])){
                include('delete_brand.php');
            }
            if (isset($_GET['list_orders'])){
                include('list_orders.php');
            }
            if (isset($_GET['list_payments'])){
                include('list_payments.php');
            }
            if (isset($_GET['list_users'])){
                include('list_users.php');
            }
            ?>
        </div>
    </div>

    <div class="bg-info text-center py-2 container-fluid">
            <p><strong>“All Rights Reserved © 2023 Your Ali Khaliq. Shopping Center"</strong></p>
    </div>

    <!-- <scripts type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->

</body>

</html>