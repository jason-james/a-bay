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

}   else {
    redirect_to(url_for('/html/to_bid.php'));
}
