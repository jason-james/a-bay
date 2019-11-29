<!--when item has been selected, details of the item is presented here-->
<?php require_once ("../../private/initialise.php") ?>

<?php include("../../private/shared/header.php")?>

<?php
// Adds watch and unwatch functionality
if (is_post_request() && isset($_POST['watch']) ) {
    echo "set";
    $listing_id = $_GET['listing_id'];
    $user_id = $_SESSION['user_id'];
    $query = "INSERT into watchlist (user_fk, listing_watched_fk) " . "VALUES ($user_id, $listing_id)";
    mysqli_query($db, $query);
} else if (is_post_request() && isset($_POST['unwatch']) ){
    $listing_id = $_GET['listing_id'];
    $user_id = $_SESSION['user_id'];
    $query = "DELETE from watchlist where user_fk = $user_id AND listing_watched_fk = $listing_id";
    mysqli_query($db, $query);
}

$item_id = $_GET['item_id'];
$listing_id = $_GET['listing_id'];

$query = "SELECT * from item where item_id = $item_id";
$query_res = mysqli_query($db, $query);
$item_details = $query_res -> fetch_assoc();

$seller_fk = $item_details ['seller_fk'];
$query = "SELECT username FROM user where user_fk = $seller_fk";
$query_res = mysqli_query($db, $query);
$seller_details = $query_res -> fetch_assoc();

$query = "SELECT * from listing where listing_id = $listing_id";
$query_res = mysqli_query($db, $query);
$listing_details = $query_res -> fetch_assoc();
$latest_bid_amount = $listing_details['latest_bid_amount'];
$is_active_listing = $listing_details['is_active_listing']
?>

<?php

$bid_set = get_list_of_bids($db, $_GET['listing_id']);  // uses the function created in deji_query_functions.php to get the results of the query

?>

<script>

    // Set the date we're counting down to
    var countDownDate = new Date("<?php echo $listing_details['end_time']?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("timer").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s";

        // If the count down is finished, set listing to expired
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "Listing Expired";

            // Update database with winning bid

            var httpRequest = new XMLHttpRequest();

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }
            httpRequest.onreadystatechange = alertContents;
            httpRequest.open('POST', '<?php echo url_for('/html/set_winning_bid.php') ?>');
            httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpRequest.send('listing_id=' + encodeURIComponent(<?php echo $listing_id?>) + '&latest_bid_amount=' +  encodeURIComponent(<?php echo $latest_bid_amount?>) + '&is_active_listing=' + encodeURIComponent(<?php echo $is_active_listing?>));

            function alertContents() {
                if (httpRequest.readyState === XMLHttpRequest.DONE) {
                    if (httpRequest.status === 200) {
                        console.log('successful ajax call', httpRequest.response);
                    } else {
                        console.log('unsuccessful ajax call', httpRequest.response);
                    }
                }
            }

        }
    }, 1000);
</script>

<body>
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
<div class="container">
<!-- Modal -->
    <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Make bid</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form action="<?php echo url_for('/html/send_bid_to_db.php?item_id=' . $item_id . "&listing_id=" . $listing_id)?>" method="post">
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">£</span>
                            </div>
                            <input type="text" required class="form-control" name="bid_amount" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Submit bid</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

<!--modal to view bids for this item button-->


<div class="modal fade" id="currentbidsModal" tabindex="-1" role="dialog" aria-labelledby="currentbidsModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5  style="text-align:center" class="modal-title" id="exampleModalLongTitle">Bids for this item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <!-- table has been inserted into card-->
                    <thead class="thead-dark">
                    <th style="text-align:center" >Bid Price</th>
                    <th style="text-align:center" >Time of Bid</th>
                    <th style="text-align:center" >Bidder</th>
                    <th style="text-align:center" ></th>

                    </thead>
                    <tbody>
                    <?php while($bid = mysqli_fetch_assoc($bid_set)) {
                        $bidder = $bid['bidder_fk'];
                        $res = mysqli_query($db, "SELECT username from user where user_fk = $bidder");
                        $bidder = $res -> fetch_assoc();
                        $bidder = $bidder['username']
                        ?>   <!-- while able to fetch a result from the bid_set, go through each and get username, bid amount and timestamp-->
                        <tr>
                            <td style="text-align:center" ><?php echo "£" . $bid['bid_amount']; ?></td>
                            <td style="text-align:center" ><?php echo $bid['bid_timestamp']; ?></td>
                            <td style="text-align:center" ><?php echo $bidder; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
</div>


<!----------------------------------------------------->

    <div class="modal fade" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="sendMessage" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Contact seller</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name" value="ucabjja">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>

    <div class="input-group my-4">
        <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
        <div class="input-group-append">
            <a class="btn btn-primary" href="search_results.php">Search</a>

            <button class="btn btn-outline-primary search-bar-dropdown-toggle dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </div>
    </div>
    <div class="row my-4">
    <div class="col-sm-5">
        <img id="item-display" src="<?php echo url_for('/html/' . $item_details['image_location']) ?> " height="375" width="450" alt=""/>
    </div>

    <div class="col-sm-7">
        <div class="h5"><?php echo $item_details['item_name'] . "  "?></div>
        <div>Time remaining: <span id="timer"></span></div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="product-price">Starting price: <span><strong>£ <?php echo $listing_details['starting_price']?></strong></span></div>
                <div class="product-price">Current bid: <span><strong><?php echo ( $listing_details['latest_bid_amount'] > 0 ? '£ '. $listing_details['latest_bid_amount'] : 'No Bids')?></strong></span></div>
                <div class="product-price">Buy it now: <span><strong>£ <?php echo $listing_details['buy_now_price']?></strong></span></div>
            </div>
            <div class="col-md-6">
                <div class="product-price">Start date: <span><strong><?php echo $listing_details['start_time']?></strong></span></div>
                <div class="product-price">End date: <span><strong><?php echo $listing_details['end_time']?></strong></span></div>
            </div>
        </div>

        <div class="btn-group cart">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bidModal">
                <i class="fas fa-credit-card mr-2"></i>Make bid
            </button>
        </div>
        <div class="btn-group wishlist my-2">
            <?php
            $user_id = $_SESSION['user_id'] ?? '';
            $qry = "SELECT * from watchlist where user_fk = $user_id AND listing_watched_fk = $listing_id";
            $res = mysqli_query($db, $qry);?>
            <?php if (isset($_SESSION['user_id']) && $res -> num_rows == 0): ?>
                <form class="mt-3" action="<?php echo "product_listing.php?item_id=" . $item_id . "&listing_id=" . $listing_id ?>" method="post">
                    <button type="submit" name="watch" id="watch" class="btn btn-outline-dark">
                        <i class="fas fa-eye mr-2"></i>Watch item
                    </button>
                </form>
            <?php elseif (isset($_SESSION['user_id'])) : ?>
                <form class="mt-3" action="<?php echo "product_listing.php?item_id=" . $item_id . "&listing_id=" . $listing_id ?>" method="post">
                    <button type="submit" name="unwatch" id="unwatch" class="btn btn-outline-dark">
                        <i class="fas fa-eye mr-2"></i>Unwatch
                    </button>
                </form>
            <?php else: ?>
                <form class="mt-3" action="<?php echo "login.php" ?>">
                    <button class="btn btn-outline-dark">
                        <i class="fas fa-eye mr-2"></i>Login to Watch Item
                    </button>
                </form>
              <?php endif ?>
        </div>

         <div class="btn-group bidsforthisitem">

             <button type="button" class="btn btn-success" data-toggle="modal" data-target="#currentbidsModal">
                 Current Bids
             </button>
        </div>
        <!-- Card -->

        <div class="card h-40 my-2">

            <!-- Card content -->
            <div class="card-body">
                <!-- Title -->
                <h5 class="card-subtitle"><a><?php echo $seller_details['username']; ?></a></h5>
                <!-- Data -->
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>

                <p class="mb-2">Seller • <?php echo $item_details['location'];?></p>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendMessage">Contact</button>
                <button type="button" class="btn btn-primary">Feedback</button>

            </div>

        </div>
        <!-- Card -->
    </div>
    </div>

<!-- Item details e.g. size etc -->

<div class="row my-4">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Item Details</h4>
                <p><strong>Name:</strong> <?php echo $item_details['item_name']?></p>
                <p><strong>Size:</strong> <?php echo $item_details['size']?></p>
                <p><strong>Location:</strong> <?php echo $item_details['location']?></p>
                <p><strong>Condition:</strong> <?php echo $item_details['state']?></p>
                <p><strong>Category:</strong> <?php echo $item_details['category']?></p>
            </div>
        </div>
    </div>
</div>
<!-- Item description -->

    <div class="row my-4">
        <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4>Product Description</h4>
                        <?php echo $item_details['description']?>
                    </div>
                </div>
        </div>
    </div>

    <h4>Recommendations</h4>
    <!-- /.row -->
    <div class="row my-4">

        <div class="col">
            <div class="card h-50">
                <a href="#"><img class="card-img-top" src="http://placehold.it/250x125" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Item Two</a>
                    </h4>
                    <h5>$24.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-50">
                <a href="#"><img class="card-img-top" src="http://placehold.it/250x125" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Item Three</a>
                    </h4>
                    <h5>$24.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-50">
                <a href="#"><img class="card-img-top" src="http://placehold.it/250x125" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Item Four</a>
                    </h4>
                    <h5>$24.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-50">
                <a href="#"><img class="card-img-top" src="http://placehold.it/250x125" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Item Four</a>
                    </h4>
                    <h5>$24.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
