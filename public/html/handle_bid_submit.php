<?php
/*a handles the bid amounts submitted by the user*/

$latest_bid = $_POST['Latest bid'] ?? '';
$bid_4 = $_POST['Bid 4'] ?? '';
$bid_3 = $_POST['Bid 3'] ?? '';
$bid_2 = $_POST['Bid 2'] ?? '';
$bid_1 = $_POST['Bid 1'] ?? '';


echo "These are the bids for this item<br />";
echo "Latest bid amount:  " . $latest_bid . "<br />";
echo "Bid 4:  " . $bid_4 . "<br />";
echo "Bid 3:  " . $bid_3 . "<br />";
echo "Bid 2:  " . $bid_2 . "<br />";
echo "Bid 1:  " . $bid_1 . "<br />";

?>