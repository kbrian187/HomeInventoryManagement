<?
/*
Brian Krukoski
createAccount.php
December, 2014
Script to create account
*/
$USERNAME="USERNAME";
$PASSWORD="PASSWORD";
$HOST="HOSTNAME";
$DB="DATABASENAME";
$URL="URL";
$UPC_TABLE="groceries";
$INV_TABLE="inventory";
$USER_TABLE="users";
$USER_COL="username";
$PASS_COL="password";
$USERPASSWORD=$_POST['password'];
$REUSERPASSWORD=$_POST['repassword'];
$NAME=$_POST['username'];
$RENAME=$_POST['reusername'];
$EMAIL=$_POST['email'];
$REEMAIL=$_POST['reemail'];


mysql_connect($HOST,$USERNAME,$PASSWORD);
@mysql_select_db($DB) or die( "Unable to select DB"); //connect to DB or die w/ error


$USER_NAME=stripslashes($NAME);
$USER_PASSWORD=stripslashes($USERPASSWORD);
$USER_EMAIL=stripslashes($EMAIL);
$USER_NAME=mysql_real_escape_string($USER_NAME);
$USER_PASSWORD=mysql_real_escape_string($USER_PASSWORD);
$USER_EMAIL=mysql_real_escape_string($USER_EMAIL);
$REUSER_NAME=stripslashes($RENAME);
$REUSER_PASSWORD=stripslashes($REUSERPASSWORD);
$REUSER_EMAIL=stripslashes($REEMAIL);
$REUSER_NAME=mysql_real_escape_string($REUSER_NAME);
$REUSER_PASSWORD=mysql_real_escape_string($REUSER_PASSWORD);
$REUSER_EMAIL=mysql_real_escape_string($REUSER_EMAIL);
	
if($USER_NAME != $REUSER_NAME || $USER_PASSWORD != $REUSER_PASSWORD || $USER_EMAIL != $REUSER_EMAIL){
	echo "<p>There was a mismatch in the values entered for either your user name, password or email. You will be redirected to the login page shortly.</p>";
	echo "<meta http-equiv='refresh' content='6;URL=http://$URL/login.php'>";
}
else{
	$QUERY="INSERT INTO $USER_TABLE VALUES ( '$USER_NAME', '$USER_EMAIL', '$USER_PASSWORD')";
	$RESULT = mysql_query($QUERY);
	if(!$RESULT){
		echo "<p>Error creating user, redirecting to login page</p>";
		echo "<meta http-equiv='refresh' content='6;URL=http://$URL/login.php'>";
	}
	else {
		echo "<p>User successfully created, returning to login page. Enjoy your Kitchen Management System.</p>";
		echo "<meta http-equiv='refresh' content='6;URL=http://$URL/login.php'>";
	}	
}
?>