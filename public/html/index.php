
<?php require_once ("../../private/initialise.php") ?>
<?php include("../../private/shared/header.php")?>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">A-Bay</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">My Listings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">Account</a>
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

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">A-Bay</h1>
            <div class="list-group">
                <a href="<?php echo url_for("/html/search_results.php?query=electronics&sortBy=expirydate") ?>" class="list-group-item">Electronics</a>
                <a href="<?php echo url_for("/html/search_results.php?query=Gaming&sortBy=expirydate") ?>" class="list-group-item">Gaming</a>
                <a href="<?php echo url_for("/html/search_results.php?query=Fashion&sortBy=expirydate") ?>" class="list-group-item">Fashion</a>
                <a href="<?php echo url_for("/html/search_results.php?query=Entertainment&sortBy=expirydate") ?>" class="list-group-item">Entertainment</a>
                <a href="<?php echo url_for("/html/search_results.php?query=Books&sortBy=expirydate") ?>" class="list-group-item">Books</a>
                <a href="<?php echo url_for("/html/search_results.php?query=Sports&sortBy=expirydate") ?>" class="list-group-item">Sports</a>
                <a href="<?php echo url_for("/html/search_results.php?query=Other&sortBy=expirydate") ?>" class="list-group-item">Other</a>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            <div class="input-group mt-4">
                <form action="search_results.php" method="GET" style="width: 100%; margin-bottom: 0.5em">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" aria-label="Text input with segmented dropdown button">
                        <div class="input-group-append">
                            <input type="submit" value="Search" class='btn btn-primary' placeholder="Search anything">
                            <select class="custom-select" name="sortBy">
                                <option value="expirydate">Soonest Expiry</option>
                                <option value="pricelowhigh">Price Low to High</option>
                                <option value="pricehighlow">Price High to Low</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.row -->

                <?php
                $query = "select listing.end_time, listing.latest_bid_amount, listing.listing_id, listing.end_time, item.*
                            from listing
                            inner join item on listing.item_id  = item.item_id
                            where listing.is_active_listing = 1";

                $query_res = mysqli_query($db, $query);


                $count = 0;
                while($res = mysqli_fetch_assoc($query_res) and $count < 6) {
                    if ($count % 3 == 0) {
                        echo '<div class="row my-4">';
                    }
                    echo '
                    <div class="col">
                    <div class="card h-50">
                        <img class="card-img-top" width="250" src="' . url_for("/html/" . $res["image_location"]) . '" alt="">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="' . url_for("/html/product_listing.php?item_id=" . $res['item_id'] . "&listing_id=" . $res['listing_id']) . '">' . $res['item_name'] . '</a>
                            </h4>
                            <h5>Latest bid: £ '.$res["latest_bid_amount"].'</h5>
                            <p class="card-text"> Ending: '.$res["end_time"].' <br> Category: '.$res["category"].' <br> '.$res["location"].' </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">'.$res["location"].'</small>
                        </div>
                    </div>
                </div>
                    ';
                $count++;
                }
                ?>
            </div>
        </div>

        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
</div>

<!-- /.Footer -->
<?php include("../../private/shared/footer.php")?>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>