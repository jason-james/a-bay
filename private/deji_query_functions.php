
<?php
function get_list_of_bids($db, $listing) {
    $query = "SELECT * FROM bid where bid_on_fk = $listing";
    $bid_set = mysqli_query($db, $query);
    return $bid_set;
}
?>