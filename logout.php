<?php

// Initialize the session
session_start();
// Unset all of the session variables
unset($_SESSION['ID']);
// Destroy the session
session_destroy();

header("Location: login.php?welcomeBack");
