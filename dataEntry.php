<?php
/*
Brian Krukoski
dataEntry.php
December, 2014
Script for increasing or decreasing the quantity of an already existing item in the database
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
$UPC_COL="upc";
$TYPE_COL="product";
$NUM_COL="quantity";
$SELECTION=$_POST['inOrOut'];
$UPC=$_POST['upc'];
$USER_COL="user";
$USER_NAME=$_SESSION['username'];


//function for writing new item html form
function writeForm($PASSED_UPC){
	
	mysql_close();//close current connection in case something goes wrong transitioning to new script
	
	echo "<p>UPC not found in the database, please enter an item type</p>";
	echo "<form action = 'newItem.php' method = 'post'>";
			echo "<input type = 'text' name = 'product' autofocus>";
			echo "<input type = 'hidden' name = 'passed_upc' value = '$PASSED_UPC' >";
			echo "<input type = 'submit' value = 'Submit'>";
		echo "</form>";
} 

mysql_connect($HOST,$USERNAME,$PASSWORD);
@mysql_select_db($DB) or die( "Unable to select DB"); //connect to DB or die w/ error
	if( $SELECTION == "input" ){
		//redirects on blank entry
		echo "<h4>Input Mode</h4>";

		$QUERY="SELECT * FROM $UPC_TABLE WHERE $UPC_COL = '$UPC'"; //selects all entries w/ appropriate upc
		$VAR=mysql_query($QUERY);
		if ( mysql_num_rows($VAR) < 1 ){ //if entry does not exist...
			writeForm($UPC);
		}
		else {//update existing item quantity in DB
			$QUERY="SELECT $TYPE_COL from $UPC_TABLE where $UPC_COL = '$UPC'";
			$ITEM=mysql_query($QUERY);
			$VAR=mysql_fetch_row($ITEM);
			$QUERY="SELECT * FROM $INV_TABLE WHERE $TYPE_COL='$VAR[0]' AND $USER_COL='$USER_NAME'";
			$RESULT=mysql_query($QUERY);
			if ( mysql_num_rows($RESULT) < 1 ){
				$QUERY="INSERT INTO $INV_TABLE VALUES ( '$VAR[0]', 1, '$USER_NAME' )";
				mysql_query($QUERY);
				header("Location: http://$URL/Project.php");
				die();
			}
			else{	//increment item quantity
				echo "<p>Increasing $VAR[0] quantity in database</p>";		
				$QUERY="UPDATE $INV_TABLE SET $NUM_COL = $NUM_COL + 1 WHERE $TYPE_COL = '$VAR[0]' AND $USER_COL='$USER_NAME'";
				mysql_query($QUERY);	
				header("Location: http://$URL/Project.php");
				die();
			}
	}
	}
	else {//reduce item quantity
		$QUERY="SELECT $TYPE_COL from $UPC_TABLE where $UPC_COL = '$UPC'";
		$ITEM=mysql_query($QUERY);
		$VAR=mysql_fetch_row($ITEM);
		echo "<p>Reducing $VAR[0] quantity in database</p>";		
		$QUERY="UPDATE $INV_TABLE SET $NUM_COL = $NUM_COL - 1 WHERE $TYPE_COL = '$VAR[0]' AND $USER_COL='$USER_NAME'";
		mysql_query($QUERY);
		
		header("Location: http://$URL/Project.php");
		
		die();

	}
mysql_close();
?>
