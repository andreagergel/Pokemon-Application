<?php

// Create and include a configuration file with the database connection
include('config.php');

// Destroy the current session
session_destroy();

// Redirect to the login page
echo("<script>location.href ='index.php';</script>");

?>
