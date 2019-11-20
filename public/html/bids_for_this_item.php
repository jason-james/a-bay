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

    <!---List of bids--->

    <div class="row mb-2">
        <div class="col-lg-8">

            <div class="row my-4">
                <div class="card h-100 w-100">
                    <div class="card-header">Bids for this item</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="<?php echo ?>">Latest bid:</a></li>
                            <li class="list-group-item"><a href="#">Bid 4:</a></li>
                            <li class="list-group-item"><a href="#">Bid 3:</a></li>
                            <li class="list-group-item"><a href="#">Bid 2:</a></li>
                            <li class="list-group-item"><a href="#">Bid 1:</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
</div>

</body>