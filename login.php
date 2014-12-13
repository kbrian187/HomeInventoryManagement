<?
/*
Brian Krukoski
login.php
December, 2014
Generic script for logging in to a system
*/
?>
<table width='300' border='0' align='center' cellpadding='0' cellspacing='1' bgcolor='#AAAAAA'>
	<tr>
		<form name='login' method='post' action='checklogin.php'>
			<td>
				<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#FFFFFF'>
						<tr>
							<td colspan='3'><strong>User Login </strong></td>
						</tr>
						<tr>
							<td width='78'>Username</td>
							<td width='6'>:</td>
							<td width='294'><input name='username' type='text' id='myUsername'></td>
						</tr>
						<tr>
							<td>Password</td>
							<td>:</td>
							<td><input name='password' type='password' id='myPassword'></td>
						</tr>
						<tr>
							<td colspan='3'><input type='submit' name='login' value='Login'></td>
						</tr>
						<tr>
							<td colspan='3'><input type='submit' name='createAccount' value='Create Account'></td>
						</tr>
					</table>
			</td>
		</form>
	</tr>
</table>