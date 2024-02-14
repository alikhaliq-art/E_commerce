<?php
include('../includes/connect.php');
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment | Card</title>

    <!-- <link rel="stylesheet" href="style.css"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="container_fluid">
        <nav class="navbar navbar-expand-lg bg-info navbar-light text-white">
            <div class="container-fluid">
                <img src="./images/cart_img.png" class="logo" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_registeration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-lg bg-secondary navbar-dark mb-2">
            <ul class="navbar-nav me-auto">
                <?php 
                if (!isset($_SESSION['user_username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link text-white' href='#'>Welcome Guest</a>
                </li>";
                }else{
                    echo"<li class='nav-item'>
                    <a class='nav-link text-white' href='#'>Welcome <strong class='text-warning'>".$_SESSION['user_username']."</strong> </a>
                    </li>";
                }


                if (!isset($_SESSION['user_username'])){
                    echo "                <li class='nav-item'>
                    <a class='nav-link text-white' href='user_login.php'>Login</a>
                    </li>";
                }else{
                    echo"<li class='nav-item'>
                    <a class='nav-link text-white' href='user_logout.php'>Logout</a>
                </li>";
                }
                ?>
            </ul>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
            <?php
            if (!isset($_SESSION['user_username'])){
                include ('user_login.php');
            }else{
                  include ('payment.php');  
                }
            ?>
                </div>
            </div>
        </div>

        <div class="bg-info text-center p-3">
            <p><strong>“All Rights Reserved © 2023 Your Ali Khaliq. Shopping Center"</strong></p>
        </div>
    </div>












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>