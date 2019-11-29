<?php
$x = 0;

foreach ($resultset as $array) {
    $x++;
    $item = $array['item_id'];
    $query = "SELECT item_name FROM item WHERE item_id = $item";
    $query_res = mysqli_query($db, $query);
    $ItemName = $query_res->fetch_assoc();
    $link = url_for('/html/product_listing.php?item_id=' . $item . "&listing_id=" . $array['listing_id']);

    echo "<tr><br>" . '<emsp><th scope = "row">' . $x . "</th><br><emsp>" . "<td>". $ItemName['item_name'] . "</td><br><emsp><td>" . $array['end_time'] . "</td><br><emsp><td>" . $array['latest_bid_amount'] . "</td><br><emsp><td>" . '<li class="list-group-item"><a href="' . $link . '"' . ">Link</a></li>" .  "</td><br></tr>" ;



}
?>


<!--//side notes-->
<!--//print_r(($resultset));-->
<!--//mysqli_free_result($query_res);-->
<!---->
<!--//$user_fk_1 = $resultset['0'];-->
<!--//$user_fk_1 = $user_fk_1['user_fk'];-->
<!--//echo $user_fk_1;-->
<!---->
<!--//foreach ($resultset as $array) {-->
<!--//    echo $array['user_fk'] . $array['end_time'] . $array['latest_bid_amount'] . $array['item_id'] . " <br>" ;-->
<!--//-->
<!--//}-->
<!--//-->
<!--//foreach ($resultset as $array) {-->
<!--//    $item = $array['item_id'];-->
<!--//    $query = "SELECT item_name FROM item WHERE item_id = $item";-->
<!--//    $query_res = mysqli_query($db, $query);-->
<!--//    $item_name = $query_res -> fetch_assoc();-->
<!--//    echo "<br>" . $item_name['item_name'];-->
<!--//}-->
<!--//-->
<!--//-->
<!--//$x = 1;-->
<!--//-->
<!--//foreach ($resultset as $array) {-->
<!--//    $x++;-->
<!--//    $item = $array['item_id'];-->
<!--//    $query = "SELECT item_name FROM item WHERE item_id = $item";-->
<!--//	$query_res = mysqli_query($db, $query);-->
<!--//	$ItemName = $query_res->fetch_assoc();-->
<!--//-->
<!--//	echo "<tr><br>" . '<emsp><th scope = "row">' . $x . "</th><br><emsp>" . "<td>". $ItemName['item_name'] . "</td><br><emsp><td>" . $array['end_time'] . "</td><br><emsp><td>" . $array['latest_bid_amount'] . "</td><br></tr>" ;-->
<!--//-->
<!--//}-->


