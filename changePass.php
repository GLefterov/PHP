<?php 
require('../mysqli_connect.php'); // Connect to the db.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

require('../mysqli_connect.php'); // Connect to the db.

$errors = []; // Initialize an error array.

if(empty($_POST['email'])){
$errors[]="You haven't written an email!";
}else{
    $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
}
}
if (!empty($_POST['password1'])) {
    if ($_POST['password1'] != $_POST['password2']) {
        $errors[] = 'Your password did not match the confirmed password.';
    } else {
        $p = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    }
} else {
    $errors[] = 'You forgot to enter your password.';
}

if (empty($errors)) { // If everything's OK.

    // Register the user in the database...

    // Make the query:
    $q = "UPDATE users SET pass=SHA2('$np', 512) WHERE email=$e";
    $r = @mysqli_query($dbc, $q); // Run the query.
    if ($r) { // If it ran OK.

        // Print a message:
        echo '<h1>Thank you!</h1>
    <p>You are now registered. In Chapter 12 you will actually be able to log in!</p><p><br></p>';

    } else { // If it did not run OK.

        // Public message:
        echo '<h1>System Error</h1>
        <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

        // Debugging message:
        echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

    } // End of if ($r) IF.

    mysqli_close($dbc); // Close the database connection.

    // Include the footer and quit the script:
    include('includes/footer.html');
    exit();

} else { // Report the errors.

    echo '<h1>Error!</h1>
    <p class="error">The following error(s) occurred:<br>';
    foreach ($errors as $msg) { // Print each error.
        echo " - $msg<br>\n";
    }
    echo '</p><p>Please try again.</p><p><br></p>';

} // End of if (empty($errors)) IF.



mysqli_close($dbc); // Close the database connection.
?>

<form action="register.php" method="post">
    <p>Email address: <input type="text" name="email" size="25" maxlength="60"> </p>
	<p>New Password: <input type=password name="password" size="15" maxlength="30"> </p>
	<p>New Password again: <input type="password" name="password2" size="15" maxlength="30"> </p>
<p> <input type="submit" name="changePass" value="Change password"></p>
</form>
<?php include('includes/footer.html'); ?>