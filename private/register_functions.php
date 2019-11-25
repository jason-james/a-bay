<?php

// Registration process. Gets info from registration form and inserts into database. //

// Set session variables
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];
$_SESSION['username'] = $_POST['username'];

// Escape POST variables to protect from SQL injection

$first_name = mysqli_escape_string($db, $_POST['firstname'] );
$last_name = mysqli_escape_string($db, $_POST['lastname']);
$username = mysqli_escape_string($db, $_POST['username']);
$email = mysqli_escape_string($db, $_POST['email']);
$password = mysqli_escape_string($db, password_hash($_POST['password'], PASSWORD_DEFAULT));
$first_name = mysqli_escape_string($db, $_POST['firstname']);
$hash = mysqli_escape_string($db, md5(rand(0,2000)));
$dob = mysqli_escape_string($db, $_POST['dob']);
$address1 = mysqli_escape_string($db, $_POST['address1']);
$address2 = mysqli_escape_string($db, $_POST['address2']);
$city = mysqli_escape_string($db, $_POST['city']);
$country = mysqli_escape_string($db, $_POST['country']);
$postcode = mysqli_escape_string($db, $_POST['postcode']);

// Check if username or email already exist

// Check email exists
if (check_exists($db, "SELECT * FROM account WHERE email ='$email'") == true) {
    $_SESSION['message'] = 'User with this email address already exists! Go back and try again.';
    redirect_to('/public/html/registration_res.php');
}
// Check username exists
if (check_exists($db, "SELECT * FROM user WHERE username ='$username'") == true) {
    $_SESSION['message_title'] = "Username exists";
    $_SESSION['message'] = 'User with this username already exists! Go back and try again.';
    redirect_to('/public/html/registration_res.php');
} else {
    // Email or username don't exist yet

    // Insert into accounts table the email, password, and hash
    $query = "INSERT INTO account (email, password, hash) " . "VALUES ('$email', '$password', '$hash')";

    if (mysqli_query($db, $query)) {
        $_SESSION['active'] = 0; // until they activate their account
        $_SESSION['logged_in'] = true;
        $_SESSION['message_title'] = "Registration Successful";
        $_SESSION['message'] = "Thank you for registering " . $first_name . ", please check your email address " . $email . " and confirm to complete registration.";

    } else {
        die(mysqli_error($db));
    }

    $id = mysqli_insert_id($db); // Store most recent user_id for use as foreign key
    $_SESSION['user_id'] = $id; // Set user_id in session
        // Insert into user table the username, first name and last name
    $query = "INSERT INTO user (user_fk, first_name, surname, username, date_of_birth) " . "VALUES ('$id', '$first_name', '$last_name', '$username', '$dob' )";
    mysqli_query($db, $query);

    // Insert into address table the address
    $query = "INSERT INTO addresses (user_fk, address1, address2, city, country, postcode) " . "VALUES ('$id', '$address1', '$address2', '$city', '$country', '$postcode' )";
    if (!mysqli_query($db, $query)) {
        die(mysqli_error($db));
    }

    redirect_to('/public/html/registration_res.php');

}

function check_exists($db, $query) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    return $result->num_rows > 0;
}