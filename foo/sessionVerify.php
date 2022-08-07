<?php
session_start();
if(empty($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true ){
    header("Location: LogIn.php");
    exit;
}
