<?
/*
Brian Krukoski
logout.php
December, 2014
Script to end session
*/
$URL="URL";
session_start();
unset($_SESSION["username"]);
header("Location: http://$URL/login.php");

?>