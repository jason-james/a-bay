<!-- to create a list of bids for a particular item -->
<?php require_once ("../../private/initialise.php") ?>

<?php include("../../private/shared/header.php")?>

<?php

$bid_set = get_list_of_bids($db, $_GET['listing_id']);  // uses the function created in deji_query_functions.php to get the results of the query

?>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">A-Bay</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">My Listings</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Account</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                            echo '<a class="nav-link" href="logout.php">Logout</a>';
                        } else {
                            echo '<a class="nav-link" href="login.php">Login</a>';
                        }?>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!---List of bids--->
<div class="container">

            <div class="row my-4 justify-content-center">
                <div class="col-lg-8">
                <div class="card h-100 w-75">
                    <div class="card-header" align="m">Bids for this item</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <table class="list">
                                <tr>            <!-- table has been inserted into card-->
                                    <th>Bid Price (£)</th>
                                    <th>Time of Bid</th>
                                    <th>Bidder</th>
                                    <th>&nbsp</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>

                                <?php while($bid = mysqli_fetch_assoc($bid_set)) {
                                    $bidder = $bid['bidder_fk'];
                                    $res = mysqli_query($db, "SELECT username from user where user_fk = $bidder");
                                    $bidder = $res -> fetch_assoc();
                                    $bidder = $bidder['username']
                                    ?>   <!-- while able to fetch a result from the bid_set, go through each and get username, bid amount and timestamp-->
                                    <tr>
                                        <td><?php echo $bid['bid_amount']; ?></td>
                                        <td><?php echo $bid['bid_timestamp']; ?></td>
                                        <td><?php echo $bidder; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>



<?php
mysqli_free_result($bid_set);      //release returned data
?>
<?php
mysqli_close($db)
?>
</body>
