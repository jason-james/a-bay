

<?php


    function get_list_of_bids($db, $item) {
        $query = "SELECT * FROM bid where bid_on_fk = $item";
        $bid_set = mysqli_query($db, $query);
        return $bid_set;
    }

?>