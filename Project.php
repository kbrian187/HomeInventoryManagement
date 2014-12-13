<?/*
Brian Krukoski
Project.php
December, 2014
Main project home page
*/?>

<html xmlns = "http://www.w3.org/1999/xhtml">
   <head>
      <title>Kitchen Management</title>
   </head>
   <body>
   	  <?php
	  $URL="URL";
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: http://$URL/login.php");
			die("Error, session not set");
		}
	  ?>
		<h1>Kitchen Management Solution</h1>
		<br></br>
		<h3>Item Entry/Removal</h3>
		<p>Select whether you would like to input or remove an item from the dropdown menu. 
		If inputting an item and that item is not currently stored in the database, you will be prompted to 
enter a description. Try to keep this description consistent across item types in order to better manage your current stocks.</p>		
		<form action = "dataEntry.php" method = "post">
			<select name = "inOrOut">
				<option value = "input">Add Item</option>
				<option value = "remove">Remove Item</option>
			</option>
			<input type = "text" name = "upc" autofocus>
			<input type = "submit" value = "Submit">
		</form>
		<br></br>
		<br></br>
		<h3>List Management</h3>
		<p>Select <b>Generate List</b> in order to display any items which you have run out of. 
		Select <b>Email</b> to email that list to yourself. Select <b>View Current Stocks</b> 
		in order to view a list of all items in the database, regardless of quantity. You may also remove selected items from the database
		permanently from here.</p>
		<form action = "generateList.php" method = "post">
			<select name = "option">
				<option value = "list">Generate List</option>
				<option value = "email">Email</option>
				<option value = "view">View Current Stocks</option>
			</select>
			<input type = "submit" value = "Generate">
		</form>
		<p><b>Logout</b></p>
		<form action = "logout.php" method = "post">
			<input type = "submit" value ="Logout">
		</form>
   </body>
</html>