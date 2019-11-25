<?php require_once ("../../private/initialise.php") ?>

<?php

$item_name = $_POST['item_name'];
$description = $_POST['description'];
$size = $_POST['size'];
$state = $_POST['condition'];
$category = $_POST['category'];
$seller_fk = $_SESSION['user_id'];
$res = mysqli_query($db, "SELECT country from addresses WHERE user_fk = '$seller_fk'");
$location = $res -> fetch_assoc();
$location = $location['country'];

$end_date = $_POST['end_date'];
$starting_price = $_POST['starting_price'];
$buy_now_price = $_POST['buy_now_price'];
$number_of_bids = 0;
$latest_bid_amount = 0;
$number_watching = 0;




$sql = "INSERT INTO item ";
$sql .= "(item_name, description, size, state, location, category, seller_fk) ";
$sql .= "VALUES (";
$sql .= "'" . $item_name . "'," ;
$sql .= "'" . $description . "'," ;
$sql .= "'" . $size . "'," ;
$sql .= "'" . $state . "'," ;
$sql .= "'" . $location . "'," ;
$sql .= "'" . $category . "'," ;
$sql .= "'" . $seller_fk . "'" ;
$sql .= ")";
$result_set1 = mysqli_query($db, $sql);
$item_id = mysqli_insert_id($db);

if($result_set1) {
    $sql2 = "INSERT INTO LISTING ";
    $sql2 .= "(end_time, starting_price, buy_now_price, number_of_bids, latest_bid_amount, number_watching, item_id) ";
    $sql2 .= "VALUES (";
    $sql2 .= "'" . $end_date . "'," ;
    $sql2 .= "'" . $starting_price . "'," ;
    $sql2 .= "'" . $buy_now_price . "'," ;
    $sql2 .= "'" . $number_of_bids . "'," ;
    $sql2 .= "'" . $latest_bid_amount . "'," ;
    $sql2 .= "'" . $number_of_bids . "'," ;
    $sql2 .= "'" . $item_id . "'" ;
    $sql2 .= ");";
    $result_set2 = mysqli_query($db, $sql2);

    if($result_set2) {
        redirect_to('/public/html/product_listing.php?item_id=' . $item_id);
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

} else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
}

//?>