<?php require_once ("../../private/initialise.php") ?>

<?php include("../../private/shared/header.php")?>



<?php
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM account WHERE user_id = $user_id";
$query_res = mysqli_query($db, $query);
$user_details = $query_res -> fetch_assoc();

$query = "SELECT * from addresses WHERE user_fk = $user_id";
$query_res = mysqli_query($db, $query);
$user_addresses = $query_res -> fetch_assoc();

$query = "SELECT * from user WHERE user_fk = $user_id";
$query_res = mysqli_query($db, $query);
$user_info = $query_res -> fetch_assoc();

?>


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
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>




    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card h-75 my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Personal Details</h5>
                        <form action="registration.php" method="post" autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstName"><strong>First Name</strong></label>
                                    <p style = "color : black"> <?php echo $user_info['first_name'] ?></p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="surName"><strong>Surname</strong></label>
                                    <p> <?php echo $user_info['surname'] ?></p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4"><strong>Email</strong></label>
                                    <p> <?php echo $user_details['email'] ?></p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4"><strong>Password</strong></label>
                                    <p> ******** </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username"><strong>Username</strong></label>
                                <p> <?php echo $user_info['username'] ?></p>
                            </div>
                            <div class="form-group">
                                <label><strong>Date of Birth</strong></label>
                                <p> <?php echo $user_info['date_of_birth'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress"><strong>Address</strong></label>
                                <p> <?php echo $user_addresses['address1'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2"><strong>Address 2</strong></label>
                                <p> <?php echo $user_addresses['address2'] ?></p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity"><strong>City</strong></label>
                                    <p> <?php echo $user_addresses['city'] ?></p>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCountry"><strong>Country</strong></label>
                                    <p> <?php echo $user_addresses['country'] ?></p>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip"><strong>Postcode</strong></label>
                                    <p> <?php echo $user_addresses['postcode'] ?></p>
                                </div>
                </div>
            </div>
        </div>
    </div>
