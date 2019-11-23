<?php

    function get_list_of_bids() {
        global $connection;
        $query = "SELECT * FROM bid";
        $bid_set = mysqli_query($connection, $query);
        return $bid_set;
    }

?>