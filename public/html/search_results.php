<?php
//require_once("../../private/initialise.php")
ini_set('display_errors', 1);
include("../../private/shared/header.php")?>

?>
<?php
$db = mysqli_connect("localhost", "root", "", 'abay');
/*
    localhost - it's location of the mysql server, usually localhost
    root - your username
    third is your password

    if connection fails it will stop loading the page and display an error
*/

mysqli_select_db($db,"abay") or die(mysqli_error($db));
/* tutorial_search is the name of database we've created */
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
                    <form action="search_results.php" method="GET">
                        <input type="text" name="query" class="form-control" aria-label="Text input with segmented dropdown button">
                        <input type="submit" value="Search" class = 'btn btn_primary'>

                    </form>
                    <p>
                        Order results
                        <select name="searchOrder">

                            <option value="X">Soonest Expiry</option>

                            <option value="H">Price Low to High</option>

                            <option value="L">Price High to Low</option>

                        </select>

                    </p>


                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                        <button class="btn btn-outline-primary search-bar-dropdown-toggle dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</button>
                </div>

                <!-- /.row -->



            </div>

            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->


<?php

$query = $_GET['query'];
//gets value sent over search form
$orderChoice = $_GET['orderChoice']
$min_length = 3;
//minimum length

if (strlen($query) >= $min_length) { // if query length is more or equal minimum length then

    $query = htmlspecialchars($query);

    $raw_results = mysqli_query($db, "SELECT * FROM item WHERE (item_name LIKE '%".$query."%')") or die(mysqli_error($db));


    if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

        while($results = mysqli_fetch_array($raw_results)){

            echo "<p><h3>".$results['item_name']."</h3>".$results['description']."<br>".$results['size']."<br>".$results['location']."<br>".$results['state']."<br>".$results['category']."<br><img src=".$results['image_location']." width='150' height='125'></p>";
            // returns the item name, description, size, location, state and an image of the item
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
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; A-Bay 2019</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>



