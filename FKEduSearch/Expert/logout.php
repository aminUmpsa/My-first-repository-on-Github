

<?php
// logout.php

session_start();


session_unset();
// Destroy the session
session_destroy();


// Redirect the user to the login page or any other appropriate page
header("Location: index.php");

exit;
?>