<?php

require_once('../../private/initialise.php');

if (is_post_request()) {


    $bid_value = $_POST['bid_amount'] ?? '';
    $bidder_fk = $_SESSION['user_id'];
    $bid_on_fk = $_GET['listing_id'];


    $query = "INSERT INTO bid (bid_amount, bidder_fk, bid_on_fk) VALUES ('$bid_value', '$bidder_fk', '$bid_on_fk')";
    $result = mysqli_query($db, $query);

    // to redirect to list of bids after bidding has been entered:
    if ($result) {
        redirect_to('/public/html/bids_for_this_item.php?listing_id=' . $bid_on_fk);

    } else {
        echo mysqli_error($db);
        db_disconnect($db);                // This is saying if the database isnt updated, state the error and disconnect from database
        exit;
    }

    // Get watchlist and send email to everyone on it

    $query = "select w.*, a.email 
            from watchlist w 
            inner join account a on a.user_id  = w.user_fk 
            where w.listing_watched_fk = $bid_on_fk";
    $value_entered = $_GET['bid_amount'];

    $res = mysqli_query($db, $query);
    $email = "jasontest797@gmail.com";
    while ($row = mysqli_fetch_assoc($res)) {
        $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $to = $row['email'];
        $subject = "Someone has bid on an item you're watching";
        $message = "Someone made a new highest bid on an item on your watchlist, make sure you outbid them to win the auction! The highest bid amount is now " . $bid_value . " GBP.";
        if (!mail($to, $subject, $message, $headers)) {
            $errorMessage = error_get_last()['message'];
        }
    }


// updates the latest bid amount in the listing page
    $query = "UPDATE listing SET latest_bid_amount = $bid_value WHERE listing_id=$bid_on_fk";
    $result = mysqli_query($db, $query);

}
