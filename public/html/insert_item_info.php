<?php require_once ("../../private/initialise.php") ?>

<?php
$user_id = $_SESSION['user_id'];
$query = "SELECT seller_fk from seller where seller_fk = $user_id";
$query_res = mysqli_query($db, $query);
if ($query_res -> num_rows == 0) { // Don't let them submit item if they don't have seller privileges
    die('You don\'t have seller permissions set. If you want seller permissions, click the button on the "Account" page.');
}

if (!empty($_POST['past_item'])) {
    // If they selected an old item, just take the item id and create a listing from it
    $item = json_decode(htmlspecialchars_decode($_POST['past_item']));
    $item_id = $item -> item_id;
} else {
    // They want to add a new item, take all details
    $item_name =  mysqli_escape_string($db, $_POST['item_name']);
    $description = mysqli_escape_string($db, $_POST['description']);
    $size = mysqli_escape_string($db, $_POST['size']);
    $state = mysqli_escape_string($db, $_POST['condition']);
    $category = mysqli_escape_string($db, $_POST['category']);
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
            echo "There was an error uploading your image!";
        }
    } else{
        echo "You cannot upload files of this type!";
    }

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

    if(!$result_set1) {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}
    $end_date = $_POST['end_date'];
    $starting_price = $_POST['starting_price'];
    $buy_now_price = $_POST['buy_now_price'];
    $number_of_bids = 0;
    $latest_bid_amount = 0;
    $number_watching = 0;
    $is_active_listing = TRUE;

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

    if ($result_set2) {
        redirect_to('/public/html/product_listing.php?item_id=' . $item_id . "&listing_id=" . $listing_id);
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

//?>