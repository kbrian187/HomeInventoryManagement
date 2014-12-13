<?
/*
Brian Krukoski
dataEntry.php
December, 2014
Script for deleting selected items from the db for a given user
*/
//check for session registration
session_start();
if(!isset($_SESSION['username'])){
	header("Location: http://$URL/login.php");
	die("Error, session not set");
}
//variables
$USERNAME="USERNAME";
$PASSWORD="PASSWORD";
$HOST="HOSTNAME";
$DB="DATABASENAME";
$URL="URL";
$UPC_TABLE="groceries";
$INV_TABLE="inventory";
$SELECTION=$_POST['toDelete'];
$TYPE_COL="product";
$USER_COL="user";
$USER_NAME=$_SESSION['username'];

mysql_connect($HOST,$USERNAME,$PASSWORD);
@mysql_select_db($DB) or die( "Unable to select DB"); //connect to DB or die w/ error
		
	//delete item
	$QUERY="DELETE FROM $INV_TABLE WHERE $TYPE_COL = '$SELECTION' AND $USER_COL='$USER_NAME'";
	mysql_query($QUERY);	
	mysql_close();
		
	header("Location: http://$URL/Project.php");
	die();

?>
