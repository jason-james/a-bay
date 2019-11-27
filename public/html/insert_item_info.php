<?php require_once ("../../private/initialise.php") ?>

<?php
//TODO, if they selected an old item, use that item info from the db using item id and create a listing based on that, instead of creating duplicate item in db
// TODO, we need to parse the POST values first to protect from SQL injection, check how its done in register_functions

$item_name = $_POST['item_name'];
$description = $_POST['description'];
$size = $_POST['size'];
$state = $_POST['condition'];
$category = $_POST['category'];
$seller_fk = $_SESSION['user_id'];
$res = mysqli_query($db, "SELECT country from addresses WHERE user_fk = '$seller_fk'");
$location = $res -> fetch_assoc();
$location = $location['country'];

$image = $_FILES['item_image'];

$image_name = $_FILES['item_image']['name'];
$image_tmpname = $_FILES['item_image']['tmp_name'];
$image_size = $_FILES['item_image']['size'];
$image_error = $_FILES['item_image']['error'];
$image_type = $_FILES['item_image']['type'];

$image_ext = explode('.', $image_name);
$image_actual_ext = strtolower(end($image_ext));

$allowed = array('jpg', 'jpeg', 'png');

if (in_array($image_actual_ext, $allowed)) {
    if ($image_error === 0) {
        if ($image_size < 100000000) {
            $image_name_new = uniqid('', true) . "." . $image_actual_ext;
            $image_destination = 'uploads/'. $image_name_new;
            move_uploaded_file($image_tmpname, $image_destination);
        } else {
            echo "Your file is too big!";
        }

    } else {
        echo "There was an erorr uploading your image!";
    }
} else{
    echo "You cannot upload files of this type!";
}



$end_date = $_POST['end_date'];
$starting_price = $_POST['starting_price'];
$buy_now_price = $_POST['buy_now_price'];
$number_of_bids = 0;
$latest_bid_amount = 0;
$number_watching = 0;
$is_active_listing = TRUE;



$sql = "INSERT INTO item ";
$sql .= "(item_name, description, size, state, location, category, image_location , seller_fk) ";
$sql .= "VALUES (";
$sql .= "'" . $item_name . "'," ;
$sql .= "'" . $description . "'," ;
$sql .= "'" . $size . "'," ;
$sql .= "'" . $state . "'," ;
$sql .= "'" . $location . "'," ;
$sql .= "'" . $category . "'," ;
$sql .= "'" . $image_destination . "',";
$sql .= "'" . $seller_fk . "'" ;
$sql .= ")";
$result_set1 = mysqli_query($db, $sql);
$item_id = mysqli_insert_id($db);


if($result_set1) {
    $sql2 = "INSERT INTO LISTING ";
    $sql2 .= "(end_time, starting_price, buy_now_price, number_of_bids, latest_bid_amount, number_watching, item_id, is_active_listing) ";
    $sql2 .= "VALUES (";
    $sql2 .= "'" . $end_date . "'," ;
    $sql2 .= "'" . $starting_price . "'," ;
    $sql2 .= "'" . $buy_now_price . "'," ;
    $sql2 .= "'" . $number_of_bids . "'," ;
    $sql2 .= "'" . $latest_bid_amount . "'," ;
    $sql2 .= "'" . $number_of_bids . "'," ;
    $sql2 .= "'" . $item_id . "'," ;
    $sql2 .= "'" . $is_active_listing . "'" ;
    $sql2 .= ");";
    $result_set2 = mysqli_query($db, $sql2);
    $listing_id = mysqli_insert_id($db);


    if($result_set2) {
        redirect_to('/public/html/product_listing.php?item_id=' . $item_id . "&listing_id=" . $listing_id);
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