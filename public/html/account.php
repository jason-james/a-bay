<?php require_once ("../../private/initialise.php") ?>

<?php include("../../private/shared/header.php")?>

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

<!-- Page Content -->

<div class="container">
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
                            <li class="list-group-item"><a href="#">Bids</a></li>
                            <li class="list-group-item"><a href="#">Purchase History</a></li>
                            <li class="list-group-item"><a href="#">Watch List</a></li>
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
                        <li class="list-group-item"><a href="#">Personal Details</a></li>
                    </ul>
                </div>
                <div class="card-footer text-center"><a href="#">Forgot Password</a></div>
            </div>
        </div>

    </div>
</div>

</body>