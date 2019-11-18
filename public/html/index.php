
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
                <a href="#" class="list-group-item">Category 1</a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

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

                <div class="col">
                    <div class="card h-75">
                        <a href="#"><img class="card-img-top" src="http://placehold.it/800x150" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item One</a>
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
        </div>
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
        </div>
        </div>

        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- /.Footer -->
<?php include("../../private/shared/footer.php")?>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>