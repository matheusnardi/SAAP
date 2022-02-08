<?php
session_start();

include 'connect.php';

session_destroy();
header('location: https://tcctcc.000webhostapp.com/login.php');

?>