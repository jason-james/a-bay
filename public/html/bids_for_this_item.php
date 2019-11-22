<!-- to create a list of bids for a particular item -->
<?php require_once ("../../private/initialise.php") ?>

<?php include("../../private/shared/header.php")?>

<?php
// to connect this file to local database

$sql = "";

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'a-bay';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); //connects to database

//perfrom database query

$bid_set = get_list_of_bids();  // uses the function created in deji_query_functions.php to get the results of the query

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


    <table class="list">
        <tr>
            <th>Bid id</th>
            <th>Bid Amount</th>
            <th>Time of bid</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>

        <?php while($bid = mysqli_fetch_assoc($bid_set)) { ?>
            <tr>
                <td><?php echo $bid['Bid id']; ?></td>
                <td><?php echo $bid['Bid Amount']; ?></td>
                <td><?php echo $bid['Time of bid']; ?></td>
            </tr>
        <?php } ?>
    </table>



<?php
mysqli_free_result($bid_set);      //release returned data
?>
<?php
mysqli_close($connection)
?>
</body>
