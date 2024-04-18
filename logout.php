<?php
session_start();

$_SESSION["check"]="No";
header("Location:login.php");

?>