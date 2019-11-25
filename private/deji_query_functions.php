

<?php


    function get_list_of_bids($db) {
        $query = "SELECT * FROM bid";
        $bid_set = mysqli_query($db, $query);
        return $bid_set;
    }

?>