<?php
session_start();
include("include/config.php");

// Unset and destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header("Location: index.php");
exit();


