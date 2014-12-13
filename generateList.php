<?
/*
Brian Krukoski
generateList.php
December, 2014
Generic script for viewing a list, permanently removing an item, or viewing the entire contents of the inventory for a given user
*/

//checks for session registration
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
$USERS_TABLE="users";
$SELECTION=$_POST['option'];
$NEW_ITEM=$_POST['product'];
$EMAIL_COL="email";
$USER_COL="user";
$USER_NAME=$_SESSION['username'];

	
mysql_connect($HOST,$USERNAME,$PASSWORD);
@mysql_select_db($DB) or die( "Unable to select DB"); //connect to DB or die w/ error
	if( $SELECTION == "list" ){
		echo "<h3>List Mode</h3>";
		echo "<p>The following items need to be purchased:</p>";
		//select items below 0 and output to the screen
		$QUERY="SELECT * FROM $INV_TABLE WHERE $USER_COL='$USER_NAME'";
		$VAR=mysql_query($QUERY);
		while($LIST=mysql_fetch_row($VAR)){
			if( $LIST[1] <= 0 ) {
				echo "<p>$LIST[0]</p>";
			}
		}
		//redirect to home page
		echo "<form action = 'Project.php'>";
			echo "<input type = 'submit' value = 'Return Home'>";
		echo "</form>";
	}
	if( $SELECTION == "view"){
		echo "<h3>View/Management Mode</h3>";
		$QUERY="SELECT * FROM $INV_TABLE WHERE $USER_COL = '$USER_NAME'";
		$VAR=mysql_query($QUERY);
			//outputs list of all items and quantities
		while($LIST=mysql_fetch_row($VAR)){
			echo "<p>$LIST[0]   $LIST[1]</p>";
		}
		//creates form allowing for the permanent removal of items from inventory table
		echo"<p>If you would like to delete an item, select the item from the drop down menu to permanently remove from the database.</p>";
		$QUERY="SELECT * FROM $INV_TABLE WHERE $USER_COL = '$USER_NAME'";
		$VAR=mysql_query($QUERY);
		echo "<form action = 'deleteItem.php' method = 'post'>";
			echo "<select name = 'toDelete'>";
			while($LIST=mysql_fetch_row($VAR)){
				echo "<option value = '$LIST[0]'>$LIST[0]</option>";
			}
			echo "</select>";
			echo "<input type = 'submit' value = 'Submit'>";
		echo "</form>";
		echo "<h4>Return to Home Page</h4>";
		echo "<form action = 'Project.php'>";
			echo "<input type = 'submit' value = 'Return'>";
		echo "</form>";
	}
	//email list
	if( $SELECTION == "email"){
		$QUERY="SELECT $EMAIL_COL FROM $USERS_TABLE WHERE username = '$USER_NAME'";
		$VAR=mysql_query($QUERY);
		$LIST=mysql_fetch_row($VAR);
		$USER_EMAIL=$LIST[0];
		echo "<p>An email has been sent to $USER_EMAIL</p>";
		$QUERY="SELECT * FROM $INV_TABLE WHERE $USER_COL='$USER_NAME'";
		$VAR=mysql_query($QUERY);
		while($LIST=mysql_fetch_row($VAR)){
			if( $LIST[1] <= 0 ) {
				$LIST_STR.=$LIST[0]."\n";
			}
		}
		echo "<p>Your list is:</p>";
		echo "$LIST_STR";
		mail($USER_EMAIL, "Kitchen Management List", $LIST_STR);
		echo "<meta http-equiv='refresh' content='6;URL=http://$URL/Project.php'>";

	}	
mysql_close();

?>
