<?
/*
Brian Krukoski
newItem.php
December, 2014
Script for handling new item creation in the inventory table
*/
//check for session registration
session_start();
if(!isset($_SESSION['username'])){
	header("Location: http://$URL/login.php");
	die("Error, session not set");
}
//variables
$URL="URL";
$USERNAME="USERNAME";
$PASSWORD="PASSWORD";
$HOST="HOSTNAME";
$DB="DATABASENAME";
$UPC_TABLE="groceries";
$INV_TABLE="inventory";
$NEW_ITEM=$_POST['product'];
$TYPE_COL="product";
$USER_COL="user";
$QUANT="quantity";
$UPC=$_POST['passed_upc'];
$USER_NAME=$_SESSION['username'];

mysql_connect($HOST,$USERNAME,$PASSWORD);
@mysql_select_db($DB) or die( "Unable to select DB"); //connect to DB or die w/ error

		$QUERY="SELECT * FROM $INV_TABLE WHERE $TYPE_COL = '$NEW_ITEM' AND $USER_COL='$USER_NAME'";
		
		$VAR=mysql_query($QUERY);
		//add new item for the first time
		if ( mysql_num_rows($VAR) < 1 ){ //if entry does not exist..
			$QUERY="INSERT INTO $INV_TABLE VALUES ( '$NEW_ITEM', 1, '$USER_NAME' )";
			mysql_query($QUERY);
			echo "<p>$NEW_ITEM added to the database</p>";
			$QUERY="INSERT INTO $UPC_TABLE VALUES ('$UPC', '$NEW_ITEM')";
			mysql_query($QUERY);
		}
		else{//update item quantity
			echo "<p>$NEW_ITEM quantity updated in the database</p>";
			$QUERY="UPDATE $INV_TABLE SET $QUANT=$QUANT+1 WHERE $TYPE_COL='$NEW_ITEM' AND $USER_COL='$USER_NAME'";
			mysql_query($QUERY);
			$QUERY="INSERT INTO $UPC_TABLE VALUES ('$UPC', '$NEW_ITEM')";
			mysql_query($QUERY);
		}
mysql_close();
//redirect
header("Location: http://$URL/Project.php");
		
die();
?>
