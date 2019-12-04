<?php require_once("../../private/initialise.php"); ?>
<?php include("../../private/shared/header.php"); ?>

<?php ini_set('display_errors', 1); ?>

<body >
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
    <div class="container" style="min-height:100vh">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">A-Bay</h1>
                <div class="list-group">
                    <a href="#" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
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
                                <select class="custom-select" name="searchOrder">
                                    <option value="X">Soonest Expiry</option>
                                    <option value="H">Price Low to High</option>
                                    <option value="L">Price High to Low</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- /.row -->
                <?php

                $query = $_GET['query'];
                //gets value sent over search form
                //$orderChoice = $_GET['orderChoice'];
                $min_length = 3;
                //minimum length

                if (strlen($query) >= $min_length) { // if query length is more or equal minimum length then

                    $query = htmlspecialchars($query);
                    $database_query = "select listing.end_time, listing.latest_bid_amount, listing.listing_id, item.*
                            from listing
                            inner join item on listing.item_id  = item.item_id
                            where listing.is_active_listing = 1 and item_name LIKE '%". $query . "%'";

                    $raw_results = mysqli_query($db, $database_query) or die(mysqli_error($db));


                    if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

                        while($results = mysqli_fetch_array($raw_results)){

                            echo ('
                    <div class="row my-4">
                        <div class="col">
                            <div class="card h-50">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="#"><img class="card-img-top" src="'.$results["image_location"].'" width=\'150\' height=\'125\' alt=""> </a>
                                        </div>
                                        <div class="col">
                                            <h4 class="card-title">
                                                <a href="' . url_for("/html/product_listing.php?item_id=" . $results['item_id'] . "&listing_id=" . $results['listing_id']) . '">'.$results["item_name"].'</a>
                                            </h4>
                                            <h5>Latest bid: £'.$results['latest_bid_amount'].'</h5>
                                            <p class="card-text">Ending: '.$results["end_time"].' <br>
                                            Category: '.$results["category"].' <br>
                                            '.$results["location"].'
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                </div>
                            </div>
                         </div>
                    </div>');
                        }
                    }
                    else{ // if there is no matching rows do following
                        echo "No results";
                    }

                }
                else{ // if query is too short
                    echo "Minimum search length is ".$min_length.' characters.';
                }
                ?>
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <?php include("../../private/shared/footer.php")?>
    <!--- Bootstrap core JavaScript  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>





