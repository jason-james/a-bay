<?php
// Login process. Gets info from registration form and inserts into database. //
// Escape email to protect against SQL injections
$email = mysqli_escape_string($db, $_POST['email']);
// Query db for email to find account
$result = mysqli_query($db,"SELECT * FROM account WHERE email='$email'");
if ( $result->num_rows == 0 ){
    // User doesn't exist, send to error page
    $_SESSION['message_title'] = "Not Registered";
    $_SESSION['message'] = "User with that email doesn't exist. Please go back and try again.";
    redirect_to('/public/html/login_res.php');
} else {
    // User exists
    $account = $result->fetch_assoc();
    $id = $account['user_id']; // Store most recent user_id for use as foreign key
    if ( password_verify($_POST['password'], $account['password']) ) {
        // Correct password
        $user = mysqli_query($db,"SELECT * FROM user WHERE user_fk='$id'");
        $user = $user->fetch_assoc();
        if ($user) {
            $_SESSION['user_id'] = $account['user_id'];
            $_SESSION['email'] = $account['email'];
            $_SESSION['active'] = $account['active'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['surname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true;
            echo print_r($_SESSION);
            //redirect_to('/public/html/account.php');
        } else {
            die(mysqli_error($db));
        }
    }
    else {
        $_SESSION['message_title'] = "Incorrect Password";
        $_SESSION['message'] = "You have entered wrong password, go back and try again.";
        redirect_to('/public/html/login_res.php');
    }
}