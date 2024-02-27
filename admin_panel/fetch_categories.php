<?php
include('../includes/connect.php');


$select_category = "SELECT * FROM `category`";
$result_category = mysqli_query($_con, $select_category);

$categories = array();

while ($row = mysqli_fetch_assoc($result_category)) {
    $categories[] = $row;
}

echo json_encode($categories);
?>
