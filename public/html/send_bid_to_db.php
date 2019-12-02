<?php

require_once('../../private/initialise.php');
$listing_id = $_GET['listing_id'];
$query = "SELECT * from listing where listing_id = $listing_id";
$query_res = mysqli_query($db, $query);
$listing_details = $query_res -> fetch_assoc();
$latest_bid_amount = $listing_details['latest_bid_amount'];


$listing_id = $_GET['listing_id'];
$bid_on_fk = $_SESSION['user_id'];
$item_id = $_GET['item_id'];
$query_z = "SELECT latest_bid_amount FROM listing WHERE item_id='$item_id'";
$queryzsql = mysqli_query($db, $query_z);
$queryzres = mysqli_fetch_assoc($queryzsql);
$queryzresult= $queryzres['latest_bid_amount'];
$bid_amount = $_POST['bid_amount'];
$starting_price = $listing_details['starting_price'];

if (is_post_request()) {


    $bidder_fk = $_SESSION['user_id'];
    $seller_id = $_GET['seller_id'];
    $bid_on_fk = $_GET['listing_id'];

    // Checks if the value entered is larger than latest bid for that item and >= starting price for listing, if not, it shows an alert
    if ($bid_amount > $queryzresult && $bid_amount >= $starting_price ) {
            // TODO: uncomment below before submitting
//        if ($seller_id == $bidder_fk) {
//            $self_bid_mess = "You are not allowed to bid on your own items, go back and try again.";
//            die($self_bid_mess);
//        }

        $query = "INSERT INTO bid (bid_amount, bidder_fk, bid_on_fk) VALUES ('$bid_amount', '$bidder_fk', '$bid_on_fk')";
        $result = mysqli_query($db, $query);
        $query = "UPDATE listing SET latest_bid_amount = $bid_amount WHERE listing_id=$bid_on_fk";
        $result = mysqli_query($db, $query);

        // Get watchlist and send email to everyone on it
        $query = "select w.*, a.email
            from watchlist w
            inner join account a on a.user_id  = w.user_fk
            where w.listing_watched_fk = $bid_on_fk";

        $res = mysqli_query($db, $query);
        $email = "jasontest797@gmail.com";

        while ($row = mysqli_fetch_assoc($res)) {
            $headers = 'From: ' . $email . "\r\n" .
                'Reply-To: ' . $email . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            $to = $row['email'];
            $subject = "Someone has bid on an item you're watching";
            $message = "Someone made a new highest bid on an item on your watchlist, make sure you outbid them to win the auction! The highest bid amount is now " . $bid_amount . " GBP.";

            if (!mail($to, $subject, $message, $headers)) {
                $errorMessage = error_get_last()['message'];
            }
        }

        $buy_now_price = $listing_details['buy_now_price'];

        if ($bid_amount >= $buy_now_price) {
            // If they bid at the buy it now price, end listing and send emails.
            $query = "UPDATE listing SET end_time = CURRENT_TIMESTAMP";
            mysqli_query($db, $query) or die(mysqli_error($db));
        }

    } else {
        $low_bid_mess = "Your bid amount is too low, please enter a value above the current bid or starting price. Hit the back button to try again.";

        die($low_bid_mess);

    }

    // to redirect to list of bids after bidding has been entered:
    global $result;
    if ($result) {
        redirect_to('/public/html/bids_for_this_item.php?listing_id=' . $bid_on_fk);
    } else {

        echo mysqli_error($db);

        db_disconnect($db);                // This is saying if the database isnt updated, state the error and disconnect from database

        exit;

    }
}