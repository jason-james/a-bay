<?php

require_once("../../private/initialise.php");

$user_id = $_GET['user_id'];
$query = "INSERT into seller (seller_fk) VALUES (" . $user_id . ")";
$query_res = mysqli_query($db, $query) or die(mysqli_error($db));
redirect_to('/public/html/account.php');