<?php require_once ("../../private/initialise.php") ?>

<?php include("../../private/shared/header.php")?>

<body>

<?php

$user_id = $_SESSION['user_id'];

$query = "SELECT DISTINCT watchlist.user_fk, listing.end_time, listing.latest_bid_amount, listing.item_id, listing.listing_id FROM listing INNER JOIN watchlist ON watchlist.user_fk = $user_id";
$query_res = mysqli_query($db, $query);
$resultset = array();

while ($row = mysqli_fetch_assoc($query_res)) {
    $resultset[] = $row;
}

?>


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

<!-- Page Content -->

<div class="container">

    <!-- List of Bids Modal -->
    <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">List of Bids</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <!-- List of Bids Modal -->
    <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">List of Bids</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <!-- Watchlist Modal -->
    <div class="modal fade" id="watchlistModal" tabindex="-1" role="dialog" aria-labelledby="watchlistModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Watchlist</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Current Bid</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <div class="row mt-4">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            echo "<h4>Welcome back, {$_SESSION['username']}!<h4>";
        } ?>
    </div>
    <div class="row mb-2">
        <div class="col-lg-8">

            <div class="row my-4">
                <div class="card h-100 w-100">
                    <div class="card-header">Buying</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#bidModal" data-toggle="modal">Bids</a></li>
                            <li class="list-group-item"><a href="#">Purchase History</a></li>
                            <li class="list-group-item"><a href="#watchlistModal" data-toggle="modal">Watch List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="card h-100 w-100">
                    <div class="card-header">Selling</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="create_item.php">Sell Item</a></li>
                            <li class="list-group-item"><a href="#">Active Listings</a></li>
                            <li class="list-group-item"><a href="#">Sold Items</a></li>
                            <li class="list-group-item"><a href="#">Unsold Items</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 my-4">
            <div class="card h-100">
                <div class="card-header">My Account</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#">Correspondence</a></li>
                        <li class="list-group-item"><a href="#">Feedback</a></li>
                        <li class="list-group-item"><a href="#">Watch List</a></li>
                        <li class="list-group-item"><a href="personal_details.php">Personal Details</a></li>
                    </ul>
                </div>
                <div class="card-footer text-center"><a href="#">Forgot Password</a></div>
            </div>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
