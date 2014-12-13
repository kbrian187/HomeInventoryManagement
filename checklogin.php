<?
/*
Brian Krukoski
checklogin.php
December, 2014
Script to check for the existence of a user or to display the form to create a new user
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
$NAME=$_POST['username'];

mysql_connect($HOST,$USERNAME,$PASSWORD);
@mysql_select_db($DB) or die( "Unable to select DB"); //connect to DB or die w/ error

if($_POST['login']){
	//security
	$USER_NAME=stripslashes($NAME);
	$USER_PASSWORD=stripslashes($USERPASSWORD);
	$USER_NAME=mysql_real_escape_string($USER_NAME);
	$USER_PASSWORD=mysql_real_escape_string($USER_PASSWORD);

	$QUERY="SELECT * FROM $USER_TABLE WHERE $USER_COL='$USER_NAME' AND $PASS_COL='$USER_PASSWORD'";
	$RESULT=mysql_query($QUERY);
	$COUNT=mysql_num_rows($RESULT);

	if($COUNT == 1)	{
		session_start();
		$_SESSION['username']=$USER_NAME;
		echo "<p>Login Successful. Redirecting to main item entry page.</p>";
		echo "<meta http-equiv='refresh' content='3;URL=http://my.fit.edu/~bkrukoski2013/Multifarious_Systems/FinalProject/Project.php'>";
	}

}

else if($_POST['createAccount']){
echo "<p>Enter username, password and email in order to register new account.</p>";
	echo "<table width='300' border='0' align='center' cellpadding='0' cellspacing='1' bgcolor='#AAAAAA'>";
		echo "<tr>";
			echo "<form name='createUser' method='post' action='createAccount.php'>";
				echo "<td>";
					echo "<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#FFFFFF'>";
						echo "<tr>";
							echo "<td colspan='3'><strong>User Login </strong></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td width='78'>Username</td>";
							echo "<td width='6'>:</td>";
							echo "<td width='294'><input name='username' type='text' id='myUsername'></td>";
							echo "<td width='78'>Re-Enter Username</td>";
							echo "<td width='6'>:</td>";
							echo "<td width='294'><input name='reusername' type='text' id='myUsername'></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>Password</td>";
							echo "<td>:</td>";
							echo "<td><input name='password' type='password' id='myPassword'></td>";
							echo "<td>Re-Enter Password</td>";
							echo "<td>:</td>";
							echo "<td><input name='repassword' type='password' id='myPassword'></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>Email</td>";
							echo "<td>:</td>";
							echo "<td><input name='email' type='text' id='myEmail'></td>";
							echo "<td>Re-Enter Email</td>";
							echo "<td>:</td>";
							echo "<td><input name='reemail' type='text' id='myEmail'></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td colspan='3'><input type='submit' name='createAccount' value='Register Account'></td>";
						echo "</tr>";
					echo "</table>";
			echo "</td>";
		echo "</form>";
	echo "</tr>";
echo "</table>";
}
?>