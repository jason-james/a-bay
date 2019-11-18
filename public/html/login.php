<?php require_once ("../../private/initialise.php") ?>

<?php include("../../private/shared/header.php")?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require("../../private/login_functions.php");
}

// If already logged in, go straight to accounts page
if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == true) {
        redirect_to('/public/html/account.php');
    }
}
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
                <li class="nav-item">
                    <a class="nav-link" href="account.php">Account</a>
                </li>
                <li class="nav-item active">
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

<!-- Form -->

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card h-75 my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                        </div>

                        <div class="form-group">
                            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        </div>

                        <button class="btn btn-primary btn-block" type="submit" name="login">Sign in</button>
                    </form>
                </div>
                <div class="card-footer"><div CLASS="text-center">Don't have an account? <a href="registration.php">Register</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>