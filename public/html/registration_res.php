<?php require_once ("../../private/initialise.php") ?>

<?php include("../../private/shared/header.php")?>

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
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Card -->
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-5 col-lg-5 mx-auto">
            <div class="card border-dark mb-3 my-5" style="max-width: 18rem;">
                <div class="card-header"><?php echo $_SESSION['message_title']?></div>
<div class="card-body text-dark">
    <p class="card-text"><?php echo $_SESSION['message'];?></p>
</div>
<div class="card-footer">
    <div CLASS="text-center"><a href="index.php">Home</a></div>
</div>
</div>
</div>
</div>
