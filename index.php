<html>
<head>
	<title>Mini Hackathon</title>
</head>
<body>
<h1>Text Message Spammer</h1>
<?php
if (!isset($_POST['submit'])){
?>

	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		<a href="/register.php"><i>Register</i></a>
		<input type="submit" name="submit" value="Login" />
	</form>
<?php
} else {
	require_once("db_const.php");
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * from users WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
	$result = $mysqli->query($sql);
	if (!$result->num_rows == 1) {
		echo "<p>Invalid username/password combination</p>";
	} else {
		echo "<p>Logged in successfully</p>";
		?>
		<form method="post" action="send.php">
		<table cellspacing="3px">
		<tr>
		<td>Phone Number:</td>
		<td><input type="text" name="senemail"></td>
		</tr>
		<tr>
		<td>Carrier:</td>
		<td>
		<select name="carrier">
		  <option value="">Select One</option>
		  <option value="@txt.att.net">ATT</option>
		  <option value="@vtext.com">Verizon</option>
			<option value="@messaging.sprintpcs.com">Sprint</option>
			<option value="@tmomail.net">T-Mobile</option>
		</select>
		</td>
		</tr>
		<tr>
		<td>Number of Messages:</td>
		<td><input type="text" name="num"><span style="color:grey;text-size:11px;">
		</td>
		</tr>
		<tr>
		<td>Text:</td>
		<td><input type="text" name="mestext"></td>
		</tr>
		</table>
		<input type="submit" name="submit" value="Send">
		</form>
		<?php
	}
}
?>
</body>
</html>
